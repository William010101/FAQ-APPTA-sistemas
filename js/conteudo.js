document.addEventListener("DOMContentLoaded", function() {
    //conteúdo que será compartilhado: Título da página + URL
    var conteudo = encodeURIComponent(document.title + " " + window.location.href);
    //altera a URL do botão
    document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" +
        conteudo;
}, false);

document.addEventListener("DOMContentLoaded", function() {
    //conteúdo que será compartilhado: Título da página + URL
    var conteudo = encodeURIComponent(window.location.href);
    //altera a URL do botão
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" +
        conteudo;
}, false);