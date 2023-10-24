import React from "react";
import {Box, Button, Container} from "@mui/material";
import ChoicesList from "./ChoicesList";


function Choices() {
    return (
        <>
            <Container sx={{
                display: "flex",
                alignItems: "center",
                justifyContent: "space-around",
                flexWrap: "wrap",
                flexDirection: "column"

            }}>
                <ChoicesList />
                <Box sx={{
                    display: "flex",
                    flexDirection: "row",
                    justifyContent: "space-around",
                    width: "100%"
                }}>
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
                </Box>
            </Container>
        </>
    );
}

export default Choices;