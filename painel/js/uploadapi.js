var feedback = function(res) {
    if (res.success === true) {
        var get_link = res.data.link.replace(/^http:\/\//i, 'https://');
        document.querySelector('.status').classList.add();
        document.querySelector('.status').innerHTML = '<br><input class="border border w-100 p-2 image-url" name="imagem" id="imagem" value=\"' + get_link + '\"/>' + '<img class="img" alt="Imgur-Upload" src=\"' + get_link + '\"/>';
    }
    
};
{/* <input class="border border w-100 p-2 image-url" name="imagem" id="imagem"value=\"' + get_link + '\"/>' + '<img class="img" alt="Imgur-Upload" src=\"' + get_link + '\"/></input> */}
new Imgur({
    clientid: 'fb4108c9c27a6c9', //You can change this ClientID
    callback: feedback
});