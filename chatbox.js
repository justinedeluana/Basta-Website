import {
  GoogleGenerativeAI
} from "@google/generative-ai";
  
  const apiKey = "AIzaSyCVDma-acKmwiRpy-uzeftIkM830-Q4sfs";
  const genAI = new GoogleGenerativeAI(apiKey);
  
  const generationConfig = {
    temperature: 1,
    topP: 0.95,
    topK: 40,
    maxOutputTokens: 8192,
    responseMimeType: "text/plain",
  };




  const model = genAI.getGenerativeModel({
    model: "gemini-1.5-flash-8b",
    generationConfig: generationConfig,
  });
  
  const chatSession =  model.startChat({
    generationConfig
  })

  export {model,chatSession};