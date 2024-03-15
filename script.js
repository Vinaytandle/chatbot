function sendMessage() {
    var userInput = document.getElementById("user-input").value;
    var chatBox = document.getElementById("chat-box");

    if (userInput !== "") {
        var userMessage = "<div class='message user-message'>" + userInput + "</div>";
        chatBox.innerHTML += userMessage;

        // Simulate bot response (replace with actual chatbot API call)
        setTimeout(function() {
            var botMessage = "<div class='message bot-message'>Your response from the chatbot API will appear here.</div>";
            chatBox.innerHTML += botMessage;
            chatBox.scrollTop = chatBox.scrollHeight;
        }, 1000);

        document.getElementById("user-input").value = "";
        chatBox.scrollTop = chatBox.scrollHeight;
    }
}
