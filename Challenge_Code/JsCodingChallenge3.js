//john and his family's restaurants bill
var bill =[
    124,
    48,
    268
];

//create array for store final paid by john
var finalPaid=new Array(3);

//function for tip calculatation 
function tipCalculation(){
    for(var i=0;i<bill.length;i++)
    {
    if(bill[i]<50)
        finalPaid[i]= bill[i] + Math.floor( bill[i] * (20/100));
    else if(bill[i] >= 50 && bill[i] <= 200)
        finalPaid[i]= bill[i] + Math.floor( bill[i] * (15/100));
    else
        finalPaid[i]= bill[i] + Math.floor( bill[i] * (10/100));
    }
}

//call the function tipCalculation
tipCalculation();

console.log(bill);

console.log(finalPaid);
