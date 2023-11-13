import React from "react";
import {Box, Button, Container} from "@mui/material";
import ChoicesList from "./ChoicesList";
import {Link} from "wouter";
import WeeklyTask from "./WeeklyTask";


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
                    <Link href="/react/choices/add">
                        <Button sx={{
                            border: 1,
                            backgroundColor: "secondary.main",
                        }} >
                            Ajouter voeux
                        </Button>
                    </Link>
                    <Link href="/react/">
                        <Button sx={{
                            border: 1,
                            backgroundColor: "secondary.main",
                        }}>
                            Valider voeux
                        </Button>
                    </Link>
                </Box>
            </Container>
            <Container sx={{
                display: "flex",
                alignItems: "center",
                justifyContent: "space-around",
                flexWrap: "wrap",
                flexDirection: "column",
                marginTop: "2%"
            }}>
               <WeeklyTask></WeeklyTask>
            </Container>
        </>
    );
}

export default Choices;