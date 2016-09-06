//informar endereco e porta do servidor WebSocket
var server = 'localhost';
var port = 8080;
var conexao;
//var desconexao;
var capture;
var limit;
var test;
var outlet;
var channel;
var module;
var conexaoAtiva;
var reset;
var moduleRand = ["192.168.1.101", "192.168.1.102"];
var channelRand = ["p", "d"];

function pageLoad()
{
    connection = document.getElementById("connectWS");
    connection.onclick = conectarWebSocket;

    //desconexao = document.getElementById("desconectarWS");
    //desconexao.onclick = desconectarWebSocket;

    outlet = document.getElementById("outletsForm");
    channel = document.getElementById("channelForm");
    module = document.getElementById("modulesForm");

    capture = document.getElementById("captureWS");
    capture.onclick = enviarCapture;

    limit = document.getElementById("limitWS");
    limit.onclick = sendLimit;

    test = document.getElementById("testWS");
    test.onclick = sendTestMessage;

    reset = document.getElementById("resetWS");
    reset.onclick = enviarReset;

    consoleLogVar = document.getElementById("consoleLog");
}

function conectarWebSocket()
{
    websocket = new WebSocket('ws://' + server + ':' + port);
    websocket.onopen = function (e) {
        onOpen(e);
    };
    websocket.onclose = function (e) {
        onClose(e);
    };
    websocket.onmessage = function (e) {
        onMessage(e);
    };
    websocket.onerror = function (e) {
        onError(e);
    };
}

function onOpen(e)
{
    consoleLog("WS Conectado!!!");
    conexaoAtiva = true;
}
function onClose(e)
{
    conexaoAtiva = false;
    consoleLog("WS Desconectado!!!");
    alert("Desconectou!!");
}

function onMessage(e)
{
    consoleLog('<span style="color: blue;">Resposta: ' + e.data + '</span>');
}

function onError(e)
{
    consoleLog('<span style="color: red;">Erro:</span> ' + e.data);
}

function enviarCapture() {

    moduleIP = module.options[module.selectedIndex].getAttribute("ip");
    if (!conexaoAtiva) {
        conectarWebSocket();
        //alert("Conexão não estava ativa, favor enviar novamente a mensagem!!!");
        //informar que está desconectado e precisa reenviar a mensagem
    } else {
        //Math.floor((Math.random() * 6) + 4);
        //websocket.send("#*capture*#" + moduleRand[Math.floor((Math.random() * 2) + 1) - 1] + ":" + Math.floor((Math.random() * 3) + 4) + ":" + channelRand[Math.floor((Math.random() * 2) + 1) - 1]);
        websocket.send("#*capture*#" + moduleIP + ":" + outlet.value + ":" + channel.value);
    }
    //consoleLog("Enviado: " + enviarMensagem.value);
}

function sendLimit() {
    moduleIP = module.options[module.selectedIndex].getAttribute("ip");
    limitSelect = document.getElementById("limitForm");
    if (!conexaoAtiva) {
        conectarWebSocket();
        alert("Conexão não estava ativa, favor enviar novamente a mensagem!!!");
        //informar que está desconectado e precisa reenviar a mensagem
    } else {
        websocket.send("#*setLimit*#" + moduleIP + ":" + outlet.value + ":" + channel.value + ":" + limitSelect.value);
    }
    //consoleLog("Enviado: " + enviarMensagem.value);
}

function sendTestMessage() {
    moduleIP = module.options[module.selectedIndex].getAttribute("ip");
    if (!conexaoAtiva) {
        conectarWebSocket();
        alert("Conexão não estava ativa, favor enviar novamente a mensagem!!!");
    } else
    {
        websocket.send("#*test*#" + moduleIP);
    }
    //consoleLog("Enviado: " + enviarMensagem.value);
}

function enviarReset() {
    moduleIP = module.options[module.selectedIndex].getAttribute("ip");
    if (!conexaoAtiva) {
        conectarWebSocket();
        alert("Conexão não estava ativa, favor enviar novamente a mensagem!!!");
        //informar que está desconectado e precisa reenviar a mensagem
    } else
    {
        websocket.send("#*reset*#" + moduleIP);
    }
    //consoleLog("Enviado: " + enviarMensagem.value);
}

function consoleLog(mensagem)
{
    //mostrar em alguma div
}

function desconectarWebSocket()
{
    websocket.close();
}

window.addEventListener("load", pageLoad, false);
