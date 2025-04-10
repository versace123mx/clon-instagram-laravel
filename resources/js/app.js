import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

let dropzone = new Dropzone("#dropzone",{
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles:".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    /*
        con esta funcion cargamos la imagen previamente carga, para el caso de
        1) se cargue la imagen, y se presione en crear publicacion y los camos de la publicacion esten vacios
    */
    init:function(){
        if(document.querySelector('#imagen').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name= document.querySelector('#imagen').value;

            this.options.addedfile.call(this, imagenPublicada)

            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `../uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },

});

dropzone.on("sending", function(file, xhr, formData){
    console.log('desde el js 1: ',file)
    console.log('desde el js 1: ',xhr)
    console.log('desde el js 1: ',formData)
})

dropzone.on('success',function(file, response){
    console.log('desde el js 2: ',file)
    console.log('desde el js 2: ',response)
    document.querySelector('#imagen').value=response.imagen
})

dropzone.on('error',function(file, message){
    console.log(message)
})

dropzone.on('removedfile',function(file){
    document.querySelector('#imagen').value=''
})