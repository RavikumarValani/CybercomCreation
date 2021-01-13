//create john object and it's properties
var john ={
    fullName : 'John',
    mass : 50, 
    height : 3
};

//create mark object and it's properties
var mark ={
    fullName : 'Mark',
    mass : 54, 
    height : 3
};

//for calculate BMI
function calculateBMI(mass,height){

    return mass / (height * height);
}

//mark's bmi store into mark object
mark.markBMI = calculateBMI(mark.mass,mark.height);

//john's bmi store into john object
john.johnBMI = calculateBMI(john.mass,john.height);

//compare BMI
if(mark.markBMI > john.johnBMI)
    console.log(mark.fullName + ' : ' +mark.markBMI);
else if(mark.markBMI < john.johnBMI)
    console.log(john.fullName + ' : ' + john.johnBMI);
else
    console.log("both john's BMI and Mark's BMI are same");