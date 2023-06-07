const searchBtn = document.getElementById('search_btn');
const mealList = document.getElementById('recipes__card');
let resultTxt = document.getElementById('recipes__meal-title').innerText;
const mealLists = document.getElementById('mealLists');
const errorMessage = document.getElementById('error_message');
var container = document.getElementById('container');
const experts=document.getElementById('experts__containing');
const experts2=document.getElementById('experts__containing2');
const experts3=document.getElementById('experts__containing3');
const experts4=document.getElementById('experts__containing4');
const menu = document.getElementById('menu');

function openmenu() {
    menu.style.width = "250px";
  }

  function closemenu() {
    menu.style.width = "0";
  }


function getMealList(event) {
    event.preventDefault()
    let searchInputTxt = document.getElementById('search_input').value.trim();
    resultTxt = "Your Searched Results:";
    fetch(`https://www.themealdb.com/api/json/v1/1/filter.php?i=${searchInputTxt}`)
        .then(response => response.json())
        .then(data => {
            let html = "";
            if (data.meals) {
                for (let i = 0; i < 3; i++) {
                    const meal = data.meals[i];
                    fetch(`https://www.themealdb.com/api/json/v1/1/lookup.php?i=${meal.idMeal}`)
                        .then(response => response.json())
                        .then(data => {
                            const mealDetails = data.meals[0];
                            const ingredientsHTML = getMealIngredientsHTML(mealDetails);
                            const mealHTML = `
                                <div class="recipes__meal-item" data-id="${mealDetails.idMeal}">
                                    <div class="recipes__meal-img">
                                        <img src="${mealDetails.strMealThumb}" alt="food">
                                    </div>
                                    <div class="recipes__meal-name">
                                        <h3 class="recipes__meal-naming">${mealDetails.strMeal}</h3>
                                        <ul class="recipes__ingredient-list">${ingredientsHTML}</ul>
                                    </div>
                                </div>
                            `;
                            html += mealHTML;
                            mealList.innerHTML = html;
                        })
                        .catch(error => {
                            // обробка помилки
                            console.log('Помилка при отриманні даних:', error);
                            errorMessage.innerText = 'Сталася помилка: ' + error.message;
                            errorMessage.classList.remove('hidden');

                        });
                }
                mealLists.classList.add('hidden');
            } else {
                mealLists.classList.remove('hidden');
                mealList.innerHTML="";
            }
        })

}
searchBtn.addEventListener('click', getMealList);
function getMealIngredientsHTML(meal) {
    let ingredientsHTML = "";
    for (let i = 1; i <= 20; i++) {
        const ingredient = meal[`strIngredient${i}`];
        const measure = meal[`strMeasure${i}`];
        if (ingredient && measure) {
            ingredientsHTML += `<li>${measure} - ${ingredient}</li>`;
        } else {
            break;
        }
    }
    return ingredientsHTML;
}

function restrictToLetters(input) {
    input.value = input.value.replace(/[^a-zA-Z]/g, '');
  }
  var acc = document.getElementsByClassName("faq__accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {

      this.classList.toggle("active");

      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  function opensForm() {
    document.getElementById("Form").style.display = "block";
    container.style.height = "650px";
    experts.style.display="none";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }
  function closesForm() {
    document.getElementById("Form").style.display = "none";
    container.style.height = "500px";
    experts.style.display="block";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }
  function opensForm2() {
    document.getElementById("Form2").style.display = "block";
    container.style.height = "650px";
    experts2.style.display="none";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }


  function closesForm2() {
    document.getElementById("Form2").style.display = "none";
    container.style.height = "500px";
    experts2.style.display="block";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }
  function opensForm3() {
    document.getElementById("Form3").style.display = "block";
    container.style.height = "650px";
    experts3.style.display="none";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }

  function closesForm3() {
    document.getElementById("Form3").style.display = "none";
    container.style.height = "500px";
    experts3.style.display="block";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }
  function opensForm4() {
    document.getElementById("Form4").style.display = "block";
    container.style.height = "650px";
    experts4.style.display="none";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }
  }

  function closesForm4() {
    document.getElementById("Form4").style.display = "none";
    container.style.height = "500px";
    experts4.style.display="block";
    if (window.matchMedia("(max-width: 960px)").matches) {
        container.style.height = "100%";
    }

}
