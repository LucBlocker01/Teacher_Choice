import React from "react";
function ChoiceItem({ data }) {
    // data -> nbGroupSelected, year, lessonInformation
    return (
        <div>{data.nbGroupSelected}</div>
    );
}

export default ChoiceItem;