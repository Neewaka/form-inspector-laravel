

var reEng = /[a-zA-Z]/gi;
var reRus = /[а-яА-Я]/gi;

//push editable string to input
$("form").submit(function() {

    var inputText = document.getElementById("inputText");
    $("#formInput").attr(
        "value",
        inputText.innerHTML.replaceAll(
            /\<span class\=\"highlight\"\>(.*?)\<\/span\>/gi,
            "$1"
        )
    );
});

//timer to rehighlight after first inspection
var typingTimer;               
var doneTypingInterval = 2000; 

$('.isInspected').on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(highlight, doneTypingInterval);
});

$('.isInspected').on('keydown', function () {
  clearTimeout(typingTimer);
});


function highlight() {
    var inputText = document.getElementById("inputText");

    function replacer(match) {
        return '<span class="highlight">' + match + "</span>";
    }

    var innerHTML = inputText.innerHTML
        .replaceAll(/\<span class\=\"highlight\"\>(.*?)\<\/span\>/gi, "$1")
        .replaceAll(reEng, replacer);
    inputText.innerHTML = innerHTML;
}

