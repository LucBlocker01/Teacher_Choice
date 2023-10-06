import React, {useEffect, useState} from "react";
import {Stack} from "@mui/material";
import {fetchMyChoice} from "../services/api/api";
import ChoiceItem from "./ChoiceItem";


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
        <Stack spacing={2} sx={{
            display: "flex",
            justifyContent: "center",
            backgroundColor: "primary.main",
            border: 1,
            marginBottom: 2,
            borderRadius: "5px",
        }}>
            {ChoiceList}
        </Stack>
    );
}

export default ChoicesList;