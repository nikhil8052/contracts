document.addEventListener("DOMContentLoaded", function () {
   


    // START OF THE CODE 



    $('.question-div').hide();
    $('.step-1').show();





    // This is the function which will show the next step 
    function show_next_step(e){

        console.log(e.target, " This is the button ")
    }






















    // END OF THE CODE 
   
    // Function to fetch questions
    // async function fetchQuestions() {
    //     try {
    //         // Fetch questions from the API
    //         var url = 'https://sagmetic.site/2023/laravel/contracts/public/api/questions';
    //         // console.log(' Thjis is the url ', url )
    //         const response = await fetch(url);
    //         const questions = await response.json();

    //         console.log( questions , " These are the questions ")
    //         // Check if the response is valid
    //         if (Array.isArray(questions)) {
    //             displayQuestions(questions);
    //         } else {
    //             console.error("Failed to fetch questions");
    //         }
    //     } catch (error) {
    //         console.error("Error fetching questions:", error);
    //     }
    // }

    // Function to display questions in the DOM
    // function displayQuestions(questions) {
    //     const container = document.getElementById("questionsContainer");
        
    //     // Clear any previous content
    //     container.innerHTML = "";

    //     // Loop through each question and create an element
    //     questions.forEach(question => {
    //         const questionElement = document.createElement("div");
    //         questionElement.classList.add("question");

    //         // Display question content and related data (customize as needed)
    //         questionElement.innerHTML = `
    //             <div class="step active" data-id="step-1">
    //                 <div class="question active">
    //                     <label class="label_question" data-json="" data-labelid="qus1">${question.question_data.question_label}</label>
                        
    //                 </div>
    //                 <div class="next-step-section">
    //                     <button class="next-step" onclick='go_to_next_step("2",event);' data-condition="" data-step="" data-another-condition="" data-another-step="">Siguiente</button>
    //                 </div>
    //             </div>
    //         `;

    //         // Append to container
    //         container.appendChild(questionElement);
    //     });
    // }

    // Call fetchQuestions on page load
    // fetchQuestions();
});
