var isBtcReload = false;
var isETHReload = false;

$(function(){

    console.log("Trading data running!");
    initBTC();


    //@trade BTC
    var done = false;
    var resetTime;
    var endCheckingReserved = false;
    var reservered = 'no';
    var biApidata;
    var openPrice = null;
    var lastOpenPrice = null;
    var lastResult = null;
    var isResult = false;
    var checkRefresh =  moment.tz(moment().add(30, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:59");

    function initBTC() {
        websocket = new WebSocket('wss://stream.binance.com:9443/ws');
        websocket.onopen = function() { //connection is open //
            websocket.send(JSON.stringify ({
                'method': 'SUBSCRIBE',
                'params': ['btcusdt@trade'],
                'id': 1
            }))
        }

        websocket.onmessage = function(event) {
        var type = 'BTC';
        var stock = JSON.parse(event.data); 
        var time =  moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss")
        var timesec = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss.SSS");
        var mytime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        var checkReservedTime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:55.000");
        var checkTime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:40.000");
        var checkTimeLimit = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:59");

        var wssdata = {"type": type,"mytimeunix": mytimeunix,"currenttime": mytime, "currentprice": parseFloat(stock.p),"transid": stock.t,"secunixtime": stock.E,"kortime": timesec};

        var unixtime1 = convertUnixtoUnix(moment().add(1, 'minutes'));
    

        if(timesec > checkReservedTime && endCheckingReserved == false){
        endCheckingReserved = true;

        $.post("php/api/user/getGameResservedMinUpdate.php", JSON.stringify(unixtime1), function(jsondata) {
                reservered = jsondata[0].r_Game_Selected;
        });
        }else if(!isResult){
            isResult = true;
            console.log("ONCE BTC: " + wssdata.mytimeunix);
        $.post("php/api/user/getResultUnixtime.php", JSON.stringify(wssdata.mytimeunix), function(jsondata) {
            lastResult = jsondata[0].r_Open;
        });
        }
        else if(resetTime == wssdata.mytimeunix){
            var mytime1 = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix1 = Math.floor(new Date(mytime1).getTime());
            var mytimeunix1 = conunix1 / 1000;

            if(lastResult != null){
                console.log("Refresh BTC Result: " +lastResult);

                resetTime = mytimeunix1;

                done = true;

                endCheckingReserved = false;

                lastOpenPrice = lastResult;
                openPrice = lastResult;
                lastResult = null;
            }else{

                $.post("php/api/user/PostWssTrade.php", JSON.stringify(wssdata), function(jsondata) {
                    if(jsondata)
                        console.log("BTC " + wssdata.currentprice + "Time: " + time);
                });
                
                $.getJSON("https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1m&limit=1", function(jsondata) {
                    var myDate = moment.tz(moment(jsondata[0][0]),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                    var unixconvert = Math.floor(new Date(myDate).getTime())
                    var unixtime = unixconvert / 1000;
                    var biApi = {"time": unixtime, "open": jsondata[0][1], "high": jsondata[0][2], "low": jsondata[0][3], "close": jsondata[0][4]};
                    var gtype = 'BTC';
                    biApidata = [{time: wssdata.mytimeunix, time_kr: myDate, open: parseFloat(biApi.open), high: parseFloat(biApi.high), low: parseFloat(biApi.low), close: parseFloat(biApi.close),gType: gtype,reserved: reservered}];
                    
                    openPrice =  parseFloat(biApi["open"]);
                })
    
                if(openPrice != lastOpenPrice){
        
                    if(time <= checkTimeLimit){
    
                        done = true;
                        
                        if(wssdata.currentprice < (openPrice + 1) && wssdata.currentprice > (openPrice - 1)){
                            return;
                        }else{
                            
                            lastOpenPrice = openPrice;
                            openPrice = null;
    
                            console.log('BTC Close: ' +timesec+ ' Price: ' +wssdata.currentprice+ 'Reserved: ' + biApidata[0].reserved + ' LastOpen: ' + lastOpenPrice);
        
                            endCheckingReserved = false;

                            var resetTime1 = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            var conunixresetTime11 = Math.floor(new Date(resetTime1).getTime());
                            var mytimeunixresetTime1 = conunixresetTime11 / 1000;
    
                            resetTime = mytimeunixresetTime1;
            
                            $.post("php/api/user/PostWsskline.php", JSON.stringify(biApidata), function(jsondata) {})

                            reservered = 'no';
                            biApidata = [];

                            $.post("php/api/user/postGameResultUpdate.php", function(jsondata) {
                                for(i = 0; i < jsondata.length; i++){
                                    var arr = {"mytimeunix": jsondata[i].b_time,"WinResult": jsondata[i].WGameResult, "BetResult": jsondata[i].BGameResult, "code": jsondata[i].b_Account_Code, "bet": jsondata[i].b_betAmount, "totalBet": jsondata[i].b_Total_BetAmount};
                                    $.post("php/api/user/postbettingTransaction.php", JSON.stringify(arr), function(jsondata) {
                                        console.log("Paid user/s: " +jsondata.length);
                                    });
                                }
                            });

                           
                            if(checkRefresh == mytime && endCheckingReserved == false){
                                isBtcReload = true;
                                if(isEthReload)
                                    setTimeout(function(){location.reload();}, 10000);
                            }
    
                        }
                    }else{
                            if(!endCheckingReserved)
                                return;

                            console.log('No Result: ' +timesec+ 'Price: ' +wssdata.currentprice);
            
                            endCheckingReserved = false;
                            var mytime1 = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            var conunix1 = Math.floor(new Date(mytime1).getTime());
                            var mytimeunix1 = conunix1 / 1000;
            
                            resetTime = mytimeunix1;
        
                            $.getJSON("https://api.binance.com/api/v3/klines?symbol=BTCUSDT&interval=1m&limit=1", function(jsondata) {
                            var myDate = moment.tz(moment(jsondata[0][0]),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            var unixconvert = Math.floor(new Date(myDate).getTime())
                            var unixtime = unixconvert / 1000;
                            var biApi = {"time": unixtime, "open": jsondata[0][1], "high": jsondata[0][2], "low": jsondata[0][3], "close": 0};
                            var gtype = 'BTC';
            
                            biApidata = [{time: wssdata.mytimeunix, time_kr: myDate, open: parseFloat(biApi.open), high: parseFloat(biApi.high), low: parseFloat(biApi.low), close: parseFloat(biApi.close),gType: gtype}];
                            $.post("php/api/user/PostWsskline.php", JSON.stringify(biApidata), function(jsondata) {})})
                            
                            $.post("php/api/user/postGameResultUpdate.php", function(jsondata) {
                                for(i = 0; i < jsondata.length; i++){
                                    var arr = {"mytimeunix": jsondata[i].b_time,"WinResult": jsondata[i].WGameResult, "BetResult": jsondata[i].BGameResult, "code": jsondata[i].b_Account_Code, "bet": jsondata[i].b_betAmount, "totalBet": jsondata[i].b_Total_BetAmount};
                                    $.post("php/api/user/postbettingTransaction.php", JSON.stringify(arr), function(jsondata) {
                                        console.log("Paid user/s: " +jsondata.length);
                                    });
                                }
                            });

                            // if(checkRefresh == mytime && endCheckingReserved == false){
                            //     checkRefresh = moment.tz(moment().add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            // }
                    }
                }
            }

        }else{
            console.log('resetTime: ' + resetTime + " / checkReservedTime: " + wssdata.mytimeunix );
            if(done)
                return;
            
            resetTime = wssdata.mytimeunix;
        }
        };

        websocket.onerror = function(ev){
            console.log("Connection Error"+ ev);

        };


        websocket.onclose = function(ev) {
            console.log("Connection Close "+ ev);

            init();
        };
    }


    function convertUnixtoUnix(format){
        var mytime = moment.tz(format,'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        return mytimeunix;
    }


    //@trade ETH
    initETH();

    var ethDone = false;
    var ethResetTime;
    var ethEndCheckingReserved = false;
    var ethReservered = 'no';
    var ethBiApidata;
    var ethOpenPrice = null;
    var ethLastOpenPrice = null;
    var ethLastResult = null;
    var ethIsResult = false;
    var ethCheckRefresh = moment.tz(moment().add(30, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:59");


    function initETH() {
        ethws = new WebSocket('wss://stream.binance.com:9443/ws');
        ethws.onopen = function() { //connection is open //
            ethws.send(JSON.stringify ({
                'method': 'SUBSCRIBE',
                'params': ['ethusdt@trade'],
                'id': 2
            }))
        }

        ethws.onmessage = function(event) {
        var type = 'ETH';
        var stock = JSON.parse(event.data); 
        var time =  moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss")
        var timesec = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:ss.SSS");
        var mytime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        var checkReservedTime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:55.000");
        var checkTime = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:40.000");
        var checkTimeLimit = moment.tz(moment(stock.E),'Asia/Seoul').format("YYYY-MM-DD HH:mm:59");

        var wssdata = {"type": type,"mytimeunix": mytimeunix,"currenttime": mytime, "currentprice": parseFloat(stock.p),"transid": stock.t,"secunixtime": stock.E,"kortime": timesec};

        var unixtime1 = convertUnixtoUnix(moment().add(1, 'minutes'));
        

        if(timesec > checkReservedTime && ethEndCheckingReserved == false){
            ethEndCheckingReserved = true;

            $.post("php/api/user/getGameResservedMinUpdateETH.php", JSON.stringify(unixtime1), function(jsondata) {
                    ethReservered = jsondata[0].r_Game_Selected;
            });
        }else if(!ethIsResult){
            ethIsResult = true;
            console.log("ONCE ETH: " + wssdata.mytimeunix);
            $.post("php/api/user/getResultUnixtimeETH.php", JSON.stringify(wssdata.mytimeunix), function(jsondata) {
                ethLastResult = jsondata[0].r_Open;
            });
        }
        else if(ethResetTime == wssdata.mytimeunix){
            var mytime1 = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
            var conunix1 = Math.floor(new Date(mytime1).getTime());
            var mytimeunix1 = conunix1 / 1000;

            if(ethLastResult != null){
                console.log("Refresh ETH Result: " + ethLastResult);

                ethResetTime = mytimeunix1;

                ethDone = true;

                ethEndCheckingReserved = false;

                ethLastOpenPrice = ethLastResult;
                ethOpenPrice = ethLastResult;
                ethLastResult = null;
            }else{

                $.post("php/api/user/PostWssTradeETH.php", JSON.stringify(wssdata), function(jsondata) {
                    if(jsondata)
                        console.log("ETH: " + wssdata.currentprice + "Time: " + timesec);
                });
                
                $.getJSON("https://api.binance.com/api/v3/klines?symbol=ETHUSDT&interval=1m&limit=1", function(jsondata) {
                    var myDate = moment.tz(moment(jsondata[0][0]),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                    var unixconvert = Math.floor(new Date(myDate).getTime())
                    var unixtime = unixconvert / 1000;
                    var biApi = {"time": unixtime, "open": jsondata[0][1], "high": jsondata[0][2], "low": jsondata[0][3], "close": jsondata[0][4]};
                    var gtype = 'ETH';
                    ethBiApidata = [{time: wssdata.mytimeunix, time_kr: myDate, open: parseFloat(biApi.open), high: parseFloat(biApi.high), low: parseFloat(biApi.low), close: parseFloat(biApi.close),gType: gtype,reserved: ethReservered}];
                    
                    ethOpenPrice =  parseFloat(biApi["open"]);
                })
    
                if(ethOpenPrice != ethLastOpenPrice){
        
                    if(time <= checkTimeLimit){
    
                        ethDone = true;
                        
                        if(wssdata.currentprice < (ethOpenPrice + 0.2) && wssdata.currentprice > (ethOpenPrice - 0.2)){
                            return;
                        }else{
                            ethLastOpenPrice = ethOpenPrice;
                            ethOpenPrice = null;
    
                            console.log('ETH Close: ' +timesec+ ' Price: ' +wssdata.currentprice+ 'Reserved: ' + ethBiApidata[0].reserved + ' LastOpen: ' + ethLastOpenPrice);
        
                            ethEndCheckingReserved = false;

                            var ethResetTime1 = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            var conunixethResetTime1 = Math.floor(new Date(ethResetTime1).getTime());
                            var mytimeunixethResetTime1 = conunixethResetTime1 / 1000;
    
                            ethResetTime = mytimeunixethResetTime1;
            
                            $.post("php/api/user/PostWssklineETH.php", JSON.stringify(ethBiApidata), function(jsondata) {})

                            ethReservered = 'no';
                            ethBiApidata = [];

                            $.post("php/api/user/postGameResultUpdateETH.php", function(jsondata) {
                                for(i = 0; i < jsondata.length; i++){
                                    var arr = {"mytimeunix": jsondata[i].b_time,"WinResult": jsondata[i].WGameResult, "BetResult": jsondata[i].BGameResult, "code": jsondata[i].b_Account_Code, "bet": jsondata[i].b_betAmount, "totalBet": jsondata[i].b_Total_BetAmount};
                                    $.post("php/api/user/postbettingTransactionETH.php", JSON.stringify(arr), function(jsondata) {
                                        console.log("Paid user/s: " +jsondata.length);
                                    });
                                }
                            });
    

                            if(ethCheckRefresh == mytime && ethEndCheckingReserved == false){
                                isEthReload = true;
                                if(isBtcReload)
                                    setTimeout(function(){location.reload();}, 10000);
                            }
                        }
                    }else{
                            if(!ethEndCheckingReserved)
                                return;

                            console.log('ETH No Result: ' +timesec+ 'Price: ' +wssdata.currentprice);
            
                            ethEndCheckingReserved = false;
                            var mytime1 = moment.tz(moment(stock.E).add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            var conunix1 = Math.floor(new Date(mytime1).getTime());
                            var mytimeunix1 = conunix1 / 1000;
            
                            ethResetTime = mytimeunix1;
        
                            $.getJSON("https://api.binance.com/api/v3/klines?symbol=ETHUSDT&interval=1m&limit=1", function(jsondata) {
                            var myDate = moment.tz(moment(jsondata[0][0]),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            var unixconvert = Math.floor(new Date(myDate).getTime())
                            var unixtime = unixconvert / 1000;
                            var biApi = {"time": unixtime, "open": jsondata[0][1], "high": jsondata[0][2], "low": jsondata[0][3], "close": 0};
                            var gtype = 'ETH';
            
                            ethBiApidata = [{time: wssdata.mytimeunix, time_kr: myDate, open: parseFloat(biApi.open), high: parseFloat(biApi.high), low: parseFloat(biApi.low), close: parseFloat(biApi.close),gType: gtype}];
                            $.post("php/api/user/PostWssklineETH.php", JSON.stringify(ethBiApidata), function(jsondata) {})})
                            
                            $.post("php/api/user/postGameResultUpdateETH.php", function(jsondata) {
                                for(i = 0; i < jsondata.length; i++){
                                    var arr = {"mytimeunix": jsondata[i].b_time,"WinResult": jsondata[i].WGameResult, "BetResult": jsondata[i].BGameResult, "code": jsondata[i].b_Account_Code, "bet": jsondata[i].b_betAmount, "totalBet": jsondata[i].b_Total_BetAmount};
                                    $.post("php/api/user/postbettingTransactionETH.php", JSON.stringify(arr), function(jsondata) {
                                        console.log("Paid user/s: " +jsondata.length);
                                    });
                                }
                            });

                            // if(ethCheckRefresh == mytime && ethEndCheckingReserved == false){
                            //     ethCheckRefresh = moment.tz(moment().add(1, 'minutes'),'Asia/Seoul').format("YYYY-MM-DD HH:mm");
                            // }
                    }
                }
            }

        }else{
            if(ethDone)
                return;
            
            ethResetTime = wssdata.mytimeunix;
        }
        };
        ethws.onerror = function(ev){
            console.log("Error"+ ev);

        };
        ethws.onclose = function(ev) {
            console.log("Close "+ ev);

            init();
        };
    }
   
    function convertUnixtoUnix(format){
        var mytime = moment.tz(format,'Asia/Seoul').format("YYYY-MM-DD HH:mm");
        var conunix = Math.floor(new Date(mytime).getTime());
        var mytimeunix = conunix / 1000;

        return mytimeunix;
    }

})

