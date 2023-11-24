import React, {useEffect} from "react";
import {Box, Button, Container} from "@mui/material";
import ChoicesList from "./ChoicesList";
import {Link} from "wouter";
import WeeklyTask from "./WeeklyTask";
import Backtrack from "../../controllers/Backtrack";


function Choices() {
    useEffect(() => {
        document.title = "SetURCAlendar - Choix"
    }, [])
    return (
        <>
            <Backtrack></Backtrack>
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
                    <Link href="/react/choices/history">
                        <Button sx={{
                            border: 1,
                            backgroundColor: "secondary.main",
                        }}>
                            Historique
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