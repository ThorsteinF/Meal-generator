document.querySelector("#generate").addEventListener("click", function () {
	if (document.querySelector("#add")) {
		document.querySelector("#add").disabled = false;
		document.querySelector("#add").style.border = "3px solid black";
	}
	var carbs = carbsList[Math.floor(Math.random() * carbsList.length)];
	var meat = meatList[Math.floor(Math.random() * meatList.length)];
	var vegetables =
		vegetablesList[Math.floor(Math.random() * vegetablesList.length)];
	document.querySelector("h2").innerHTML =
		carbs + " with " + meat + " and " + vegetables + " on the side";
	document.querySelector("#carbs").value = carbs;
	document.querySelector("#meat").value = meat;
	document.querySelector("#vegetable").value = vegetables;
});

var carbsList = [
	"Basmati carbs",
	"Black carbs",
	"Jasmin carbs",
	"Brown carbs",
	"Red cargo carbs",
	"Sticky carbs",
	"Long grain white carbs",
	"Medium grain white carbs",
	"Calrose",
];

var meatList = [
	"Salmon",
	"Cod",
	"Sardine",
	"Macrell",
	"Bacon",
	"Chicken breast",
	"Chicken thigh",
	"Chicken wings",
	"Beef chuck",
	"Beef brisket",
	"Wagyou beef",
	"Sirloin steak",
	"Pork",
];

var vegetablesList = [
	"acorn squash",
	"alfalfa sprout",
	"amaranth",
	"anise",
	"artichoke",
	"arugula",
	"asparagus",
	"aubergine",
	"azuki bean",
	"banana squash",
	"basil",
	"bean sprout",
	"beet",
	"black bean",
	"black-eyed pea",
	"bok choy",
	"borlotti bean",
	"broad beans",
	"broccoflower",
	"broccoli",
	"brussels sprout",
	"butternut squash",
	"cabbage",
	"calabrese",
	"caraway",
	"carrot",
	"cauliflower",
	"cayenne pepper",
	"celeriac",
	"celery",
	"chamomile",
	"chard",
	"chayote",
	"chickpea",
	"chives",
	"cilantro",
	"collard green",
	"corn",
	"corn salad",
	"courgette",
	"cucumber",
	"daikon",
	"delicata",
	"dill",
	"eggplant",
	"endive",
	"fennel",
	"fiddlehead",
	"frisee",
	"garlic",
	"gem squash",
	"ginger",
	"green bean",
	"green pepper",
	"habanero",
	"herbs and spice",
	"horseradish",
	"hubbard squash",
	"jalapeno",
	"jerusalem artichoke",
	"jicama",
	"kale",
	"kidney bean",
	"kohlrabi",
	"lavender",
	"leek ",
	"legume",
	"lemon grass",
	"lentils",
	"lettuce",
	"lima bean",
	"mamey",
	"mangetout",
	"marjoram",
	"mung bean",
	"mushroom",
	"mustard green",
	"navy bean",
	"new zealand spinach",
	"nopale",
	"okra",
	"onion",
	"oregano",
	"paprika",
	"parsley",
	"parsnip",
	"patty pan",
	"pea",
	"pinto bean",
	"potato",
	"pumpkin",
	"radicchio",
	"radish",
	"rhubarb",
	"rosemary",
	"runner bean",
	"rutabaga",
	"sage",
	"scallion",
	"shallot",
	"skirret",
	"snap pea",
	"soy bean",
	"spaghetti squash",
	"spinach",
	"squash",
	"sweet potato",
	"tabasco pepper",
	"taro",
	"tat soi",
	"thyme",
	"topinambur",
	"tubers",
	"turnip",
	"wasabi",
	"water chestnut",
	"watercress",
	"white radish",
	"yam",
	"zucchini",
];