import React from "react";
import Header from "../components/Header";
import {ThemeProvider} from "@mui/material";
import useTheme from "../hooks/useTheme"
import Home from "../components/Home";
import Index from "../components/Index";
import {Route, Router} from "wouter";
import Choices from "../components/Choice/Choices";
import CssBaseline from '@mui/material/CssBaseline';
import AddChoices from "../components/addChoices/AddChoices";
import AdminPanel from "../components/Admin/AdminPanel";
import {Provider} from "react-redux";
import store from "../store/index";
import Backtrack from "./Backtrack";


function App() {
    const {isNormal, theme, toggleTheme} = useTheme();
    return (
        <Provider store={store}>
            <ThemeProvider theme={theme}>
                <CssBaseline />
                <Header toggleTheme={toggleTheme} isNormal={isNormal}></Header>
                <Backtrack ></Backtrack>
                <Router>
                    <Route path="/react" component={Home}/>
                    <Route path="/" component={Index}></Route>
                    <Route path="/react/choices" component={Choices}/>
                    <Route path="/react/choices/add" component={AddChoices}/>
                    <Route path="/react/admin" component={AdminPanel}/>
                </Router>
            </ThemeProvider>
        </Provider>
    );
}

export default App;
