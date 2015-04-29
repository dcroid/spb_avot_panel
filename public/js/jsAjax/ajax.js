var currentValue = 0;
function handleClick(myRadio, idAdvert) {

    $.ajax({
        url: '/advert/redbal/?actionCheckBox='+ myRadio.value +'&id=' + idAdvert +'&param=' + myRadio.name ,
        success: function(data) {
            $('.results').html(data);
        }
    });



}