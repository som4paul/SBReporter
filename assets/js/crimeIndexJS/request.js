
var Request = function (){}
Request.prototype.post = function (url, data) {
    var respose = "";
    $.ajax({
        url: url,
        type: 'POST',
        data: {data},
        async: false,
        success: function(resp){
            // server gives responce in format of {'response':'success'}
            respose = resp;
        }
    });
    return respose;
}
