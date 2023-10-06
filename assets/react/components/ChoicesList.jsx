import React, {useEffect, useState} from "react";
import {Stack} from "@mui/material";
import {fetchMyChoice} from "../services/api/api";


function ChoicesList() {
    const [ ChoiceList, setChoiceList ] = useState() ;

    useEffect(() => {
        fetchMyChoice().then((data) => {
            setChoiceList(
                data["hydra:member"].map((choice) => (
                    <ChoiceItem data={choice}></ChoiceItem>
                ))
            );
        });
    }, []);

    return (
    );
}

export default ChoicesList;