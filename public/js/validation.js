//validation form
$(document).ready(function(){
    var formPost = $("#form-post");
    var titlePost = document.getElementById("title-form");
    var detailsPost = document.getElementById("details"); 
    var authorPost = document.getElementById("author-form");
    var formPostUpdate = $("#form-post-update");
    var titlePostUpdate = document.getElementById("title-form-update");
    var detailsPostUpdate = document.getElementById("details-form-update"); 
    var authorPostUpdate = document.getElementById("author-form-update");
    var formEvent = $("#form-event");
    var titleEvent = document.getElementById("title-event");
    var detailsEvent = document.getElementById("details-event");
    var dateEvent = document.getElementById("date-event");
    var timeEvent = document.getElementById("time-event");
    var pseudoEvent = document.getElementById("pseudo-event");
    var formEventUpdate = $("#form-event-update");
    var titleEventUpdate = document.getElementById("title-event-update");
    var detailsEventUpdate = document.getElementById("details-event-update");
    var dateEventUpdate = document.getElementById("date-event-update");
    var timeEventUpdate = document.getElementById("time-event-update");
    var pseudoEventUpdate = document.getElementById("pseudo-event-update");

    formPost.submit(function(e){
        if(titlePost.value == ""){
            e.preventDefault();
            titlePost.focus();
            titlePost.classList.add("is-invalid");
            $("#msg-invalid-post").css("display", "block");
        }
        else if(detailsPost.value == ""){
            e.preventDefault();
            detailsPost.focus();
            detailsPost.classList.add("is-invalid");
            $("#msg-invalid-post").css("display", "block");
        }
        else if(authorPost.value == ""){
            e.preventDefault();
            authorPost.focus();
            authorPost.classList.add("is-invalid");
            $("#msg-invalid-post").css("display", "block");
        }
        else{
            alert("L\'article a bien été ajouté !");
        }
    });

    formPostUpdate.submit(function(e){
        if(titlePostUpdate.value == ""){
            e.preventDefault();
            titlePostUpdate.focus();
            titlePostUpdate.classList.add("is-invalid");
            $("#msg-invalid-post-update").css("display", "block");
        }
        else if(detailsPostUpdate.value == ""){
            e.preventDefault();
            detailsPostUpdate.focus();
            detailsPostUpdate.classList.add("is-invalid");
            $("#msg-invalid-post-update").css("display", "block");
        }
        else if(authorPostUpdate.value == ""){
            e.preventDefault();
            authorPostUpdate.focus();
            authorPostUpdate.classList.add("is-invalid");
            $("#msg-invalid-post-update").css("display", "block");
        }
        else{
            alert("L\'article a bien été modifié !");
        }
    });

    formEvent.submit(function(e){
        var regExpDate = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
        var regExpTime = /(2[0-3]|[01][0-9]):[0-5][0-9]/;

        if(titleEvent.value == ""){
            e.preventDefault();
            titleEvent.focus();
            titleEvent.classList.add("is-invalid");
            $("#msg-invalid-event").css("display", "block");
        }
        else if(detailsEvent.value == ""){
            e.preventDefault();
            detailsEvent.focus();
            detailsEvent.classList.add("is-invalid");
            $("#msg-invalid-event").css("display", "block");
        }
        else if(pseudoEvent.value == ""){
            e.preventDefault();
            pseudoEvent.focus();
            pseudoEvent.classList.add("is-invalid");
            $("#msg-invalid-event").css("display", "block");
        }

        else if(!dateEvent.value.match(regExpDate)){
            e.preventDefault();
            dateEvent.focus();
            dateEvent.classList.add("is-invalid");
            $("#msg-invalid-event").css("display", "block");
        }

        else if(!timeEvent.value.match(regExpTime)){
            e.preventDefault();
            timeEvent.focus();
            timeEvent.classList.add("is-invalid");
            $("#msg-invalid-event").css("display", "block");
        }

        else{
            alert("L\'évènement a bien été crée !");
        } 
    });

    formEventUpdate.submit(function(e){
        var regExpDate = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
        var regExpTime = /(2[0-3]|[01][0-9]):[0-5][0-9]/;

        if(titleEventUpdate.value == ""){
            e.preventDefault();
            titleEventUpdate.focus();
            titleEventUpdate.classList.add("is-invalid");
            $("#msg-invalid-event-update").css("display", "block");
        }
        else if(detailsEventUpdate.value == ""){
            e.preventDefault();
            detailsEventUpdate.focus();
            detailsEventUpdate.classList.add("is-invalid");
            $("#msg-invalid-event-update").css("display", "block");
        }
        else if(!dateEventUpdate.value.match(regExpDate)){
            e.preventDefault();
            dateEventUpdate.focus();
            dateEventUpdate.classList.add("is-invalid");
            $("#msg-invalid-event-update").css("display", "block");
        }
        else if(!timeEventUpdate.value.match(regExpTime)){
            e.preventDefault();
            timeEventUpdate.focus();
            timeEventUpdate.classList.add("is-invalid");
            $("#msg-invalid-event-update").css("display", "block");
        }
        else if(pseudoEventUpdate.value == ""){
            e.preventDefault();
            pseudoEventUpdate.focus();
            pseudoEventUpdate.classList.add("is-invalid");
            $("#msg-invalid-event-update").css("display", "block");
        }
        else{
            alert("L\'évènement a bien été modifié !");
        }
    });
});

//Validation comment
$(document).ready(function(){
    var form = $('#form-comment');
    var pseudo = document.getElementById('author_comment');

    form.submit(function(e){
        if(pseudo.value == ""){
            e.preventDefault();
            pseudo.focus();
            pseudo.classList.add("is-invalid");
            $("#msg-invalid-pseudo").css("display", "block");
            $("#msg-invalid-pseudo").text('Un pseudo est requis.');
        }
        
        else if(pseudo.value.length >= 32){
            e.preventDefault();
            pseudo.focus();
            pseudo.classList.add("is-invalid");
            $("#msg-invalid-pseudo").css("display", "block");
            $("#msg-invalid-pseudo").text('Pseudo trop long. (moins de 32 caractères)');
        }

        else if(pseudo.value.length <= 4){
            e.preventDefault();
            pseudo.focus();
            pseudo.classList.add("is-invalid");
            $("#msg-invalid-pseudo").css("display", "block");
            $("#msg-invalid-pseudo").text('Pseudo trop court. (plus de 4 caractères)');
        }
    });
});