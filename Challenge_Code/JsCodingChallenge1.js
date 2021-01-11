var john_Mass , john_Height , john_BMI;
var mark_Mass , mark_Height , mark_BMI;
var isTrue , bodyMassIndex;

alert('Enter detail of mark');

mark_Height=prompt('Height of mark:');
mark_Mass=prompt('Mass of mark:');

john_Height=prompt('Height of john:');
john_Mass=prompt('Mass of john:');

//calculate mark's body mass index and store into mark_BMI
mark_BMI=mark_Mass/(mark_Height*mark_Height);

//calculate john's body mass index and store into john_BMI
john_BMI=john_Mass/(john_Height*john_Height);

//compare both of BMI
isTrue=mark_BMI > john_BMI;

//print result in console
console.log("Is mark's BMI higher than John's?",isTrue);

