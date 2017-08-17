$(document).ready(function(){

  // when select image event change
  
  $("#select-image").change(function(){
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        // after image load
        reader.onload = function (e) {
            // pass parameter from DOM
            // display text
            $('#upload_img').attr('src', e.target.result);
            $('#upload_img').removeClass('hidden');
            $('#buttonUpload').removeClass('hidden');
            $('#text-information').html('Use mouse so create drop');
            $('#text-information').removeClass('alert-info').addClass('alert-success');

            // active crop
            $('#upload_img').Jcrop({
              aspectRatio: 1,
              onSelect: atualizaCoordenadas,
              onChange: atualizaCoordenadas
            });

            // Calculate size image
            defineTamanhoImagem(e.target.result,$('#upload_img'));
        }
       
        // carry image and call 'reader.onload'
        reader.readAsDataURL(this.files[0]);
    }
  });

  // when click button drop
  // verify area drop
  $('#buttonUpload').click(function(){
    if (parseInt($('#wcrop').val())) return true;
    alert('Select drop area');
    return false;
  });
})

// Updating the coordinates corresponding to the cut point
// each modify
// it call by  events onSelect and onChange jCrop
function atualizaCoordenadas(c)
{
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#wcrop').val(c.w);
  $('#hcrop').val(c.h);
};

// preview original image and drop image

function defineTamanhoImagem(imgOriginal, imgVisualizacao) {
  var image = new Image();
  image.src = imgOriginal;

  image.onload = function() {
    $('#wvisual').val(imgVisualizacao.width());
    $('#hvisual').val(imgVisualizacao.height());
    $('#woriginal').val(this.width);
    $('#horiginal').val(this.height);
  };
}
