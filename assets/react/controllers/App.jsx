import React from "react";
import Header from "../components/Header";
import {Button, Container, createTheme, ThemeProvider} from "@mui/material";
import {Normal} from "../themes/Normal";

function App() {
    const theme = createTheme(Normal);
    return (
        <ThemeProvider theme={theme}>
            <Header></Header>
            <Container sx={{
                display: "flex",
                alignItems: "center",
                height: "100%",
            }}>
                <Button sx={{
                    border: 1,
                    mt: "15%",
                    p: "15%",
                    backgroundColor: "secondary.main",
                }}>Emettre ses voeux</Button>
                <Button sx={{
                    border: 1,
                    ml: "5%",
                    mt: "15%",
                    p: "15%",
                    backgroundColor: "secondary.main",
                }}>Consulter son EDT</Button>
            </Container>
        </ThemeProvider>
    );
}

export default App;
