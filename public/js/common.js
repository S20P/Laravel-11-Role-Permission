console.log("Common js");

console.log("CSRF",$('meta[name="csrf-token"]').attr('content'));

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



