import React from "react";
import Header from "../components/Header";
import {ThemeProvider} from "@mui/material";
import useTheme from "../hooks/useTheme"
import Index from "../components/Index";
import {Route, Router} from "wouter";
import Choices from "../components/Choice/Choices";
import CssBaseline from '@mui/material/CssBaseline';
import AddChoices from "../components/addChoices/AddChoices";
import {Provider} from "react-redux";
import store from "../store/index";
import History from "../components/History/History";


function App() {
    const {isNormal, theme, toggleTheme} = useTheme();
    return (
        <Provider store={store}>
            <ThemeProvider theme={theme}>
                <CssBaseline />
                <Header toggleTheme={toggleTheme} isNormal={isNormal}></Header>
                <Router>
                    <Route path="/react" component={Choices}/>
                    <Route path="/" component={Index}/>
                    <Route path="/react/choices" component={Choices}/>
                    <Route path="/react/choices/add" component={AddChoices}/>
                    <Route path="/react/choices/history" component={History}/>
                </Router>
            </ThemeProvider>
        </Provider>
    );
}

export default App;
