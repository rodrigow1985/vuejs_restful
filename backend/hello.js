$(document).ready(function () {
  $.ajax({
    // url: 'http://rest-service.guides.spring.io/greeting'
    url: 'http://desa.midulcedanna.com.ar/php/webservice/rest_full/index.php?action=peoples&id=1'
  }).then(function (data) {
    $('.greeting-id').append(data.id)
    $('.greeting-content').append(data.nombre)
  })
})
