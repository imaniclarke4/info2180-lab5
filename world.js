window.addEventListener("load", function () {
    const lookup = document.querySelector("#lookup");
    const city_button = document.querySelector("#city_lookup");
  
    city_button.addEventListener("click", () => {
      performLookup("city");
    });
  
    lookup.addEventListener("click", () => {
      performLookup("country");
    });
});
  
async function performLookup(type) {
    const fieldinput = document.querySelector("#country").value;
    const fieldresult = document.querySelector("#result");
  
    let url = "";
    if (type === "country") {
      url = `world.php?country=${fieldinput}&context=''`;
    } else {
      url = `world.php?country=${fieldinput}&context=cities`;
    }
  
    const response = await fetchData(url);
    console.log(response);
    fieldresult.innerHTML = response;
}
  
async function fetchData(url) {
    return await fetch(url).then((response) => {
      let data = response.text();
      return data;
    });
}
