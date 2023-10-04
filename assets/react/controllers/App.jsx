import React from "react";
import Header from "../components/Header";
import {Button, createTheme, ThemeProvider} from "@mui/material";
import {Normal} from "../themes/Normal";

function App() {
    const theme = createTheme(Normal);
    return (
        <ThemeProvider theme={theme}>
            <Header></Header>
            <Button>Emettre ses voeux</Button>
            <Button>Consulter son EDT</Button>
        </ThemeProvider>
    );
}

export default App;
