$(document).ready(function() {
    $(".cjChatEventShow").click(function(event) {
        event.preventDefault();
        $(".cjChatTab").slideUp();
        $(".cjContentChat").slideToggle();
        $(".cjChatBody").scrollTop($(".cjChatBody")[0].scrollHeight);
    });

    $(".cjChatEventHide").click(function(event) {
        event.preventDefault();
        $(".cjContentChat").slideUp();
        $(".cjChatTab").slideToggle();
    });
});