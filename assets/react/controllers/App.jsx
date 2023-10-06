import React from "react";
import Header from "../components/Header";
import {Button, Container, createTheme, ThemeProvider} from "@mui/material";
import {Normal} from "../themes/Normal";
import Home from "../components/Home";
import {Route, Router} from "wouter";

function App() {
    const theme = createTheme(Normal);
    return (
        <ThemeProvider theme={theme}>
            <Header></Header>
            <Router>
                <Route path="/react">
                    <Home/>
                </Route>
            </Router>
        </ThemeProvider>
    );
}

export default App;
