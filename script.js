import { model, chatSession } from "./chatbox.js";

const inputBox = document.getElementById("user-input");
const sendButton = document.getElementById("send-btn");
const chatBody = document.getElementById("chat-body");

const createMessageBubble = (message, sender) => {
  const messageDiv = document.createElement("div");
  messageDiv.classList.add("chat-message", sender);
  messageDiv.textContent = message;
  return messageDiv;
};

const sendRequest = async () => {
  const userText = inputBox.value.trim();
  if (!userText) return; 

  const userMessage = createMessageBubble(userText, "user");
  chatBody.appendChild(userMessage);
  inputBox.value = ""; 
  chatBody.scrollTop = chatBody.scrollHeight; 

  try {
    const result = await chatSession.sendMessage(userText);
    const response = await result.response.text();

    const botMessage = createMessageBubble(response, "bot");
    chatBody.appendChild(botMessage);
    chatBody.scrollTop = chatBody.scrollHeight; 
  } catch (error) {
    console.error(error);
    const errorMessage = createMessageBubble("An error occurred. Please try again.", "bot");
    chatBody.appendChild(errorMessage);
    chatBody.scrollTop = chatBody.scrollHeight; 
  }
};

sendButton.addEventListener("click", sendRequest);
inputBox.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    sendRequest();
  }
});
