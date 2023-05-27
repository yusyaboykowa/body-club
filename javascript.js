const searchBtn = document.getElementById('search_btn');
const mealList = document.getElementById('recipes__card');


searchBtn.addEventListener('click', getMealList);

function getMealList() {
    let searchInputTxt = document.getElementById('search_input').value.trim();
    document.getElementById('recipes__meal-title').innerText = "Your Searched Results:";

    fetch(`https://www.themealdb.com/api/json/v1/1/filter.php?i=${searchInputTxt}`)
        .then(response => response.json())
        .then(data => {
            let html = "";
            if (data.meals) {
                for (let i = 0; i < Math.min(data.meals.length, 3); i++) {
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
                        });
                };
                mealList.classList.remove('notFound');
            } else {
                html = "Sorry, we didn't find any meal!";
                mealList.classList.add('notFound');
                mealList.innerHTML = html;
            }
        });
}

// Get HTML for the meal ingredients
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