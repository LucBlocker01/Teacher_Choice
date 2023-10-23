import React from "react";
import {Button, Container} from "@mui/material";
import ChoicesList from "./ChoicesList";


function Choices() {
    return (
        <>
            <Container sx={{
                display: "flex",
                alignItems: "center",
                justifyContent: "space-around",
                flexWrap: "wrap"
            }}>
                <ChoicesList />
                <Button sx={{
                    border: 1,
                    backgroundColor: "secondary.main",
                }}>
                    Ajouter voeux
                </Button>
                <Button sx={{
                    border: 1,
                    backgroundColor: "secondary.main",
                }}>
                    Valider voeux
                </Button>
            </Container>
        </>
    );
}

export default Choices;