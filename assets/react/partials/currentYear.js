export function getCurrentYear(){

    //Get current month and years
    const month = new Date().getMonth();
    let year1 = new Date().getFullYear();
    let year2 = new Date().getFullYear()+1;

    //If the month number is less than 8 (therefore, current month is in between January and July (included), remove 1 to both years
    if (month < 8) {
        year1 -= 1
        year2 -= 1
    }

    year1 = year1.toString()
    year2 = year2.toString()

    return year1+'/'+year2
}