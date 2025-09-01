// $(document).ready( function () {
//     $('.overlayAllPage').css("display","none");
//     $('.overlayForm').css("display","none");
// });
// $('.saveFicha').on('click',function(){
//     var formData = new FormData($("#fvcatastro")[0]);
//     // for (let [key, value] of formData.entries()) {
//     //     console.log(key, value);
//     // }
//     jQuery.ajax({
//         url: "{{ url('catastro/save') }}",
//         method: 'get',
//         data: formData,
//         dataType: 'json',
//         processData: false,
//         contentType: false,
//         success: function (r) {
//             console.log(r)
//             // if (r.state)
//             // {
//             //     cleanForm();
//             //     $('.save').prop('disabled',false);
//             // }
//             // msgImportant(r);
//             // $('.overlayForm').css("display","none");
//         },
//         error: function (xhr, status, error) {
//             msgImportantShow('Algo salio mal, porfavor contactese con el Administrador.','-','error')
//             console.log(error)
//             $('.overlayForm').css("display","none");
//         }
//     });
// })
