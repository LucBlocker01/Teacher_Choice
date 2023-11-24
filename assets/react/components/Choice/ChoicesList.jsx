import React, {useEffect, useState} from "react";
import {
    Box,
    Container,
    Tab,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Tabs,
    Typography
} from "@mui/material";
import {fetchMyChoice} from "../../services/api/api";
import ChoiceItem from "./ChoiceItem";
import Paper from "@mui/material/Paper";
import {fetchSemesters} from "../../services/api/choice";
import * as PropTypes from "prop-types";

function TabPanel({ children, value, index, ...other }) {
    return (
        <div role="tabpanel" hidden={value !== index} {...other}>
            {value === index && (
                <Box p={3}>
                    <Typography component={'span'} >{children}</Typography>
                </Box>
            )}
        </div>
    );
}

function Typograghy(props) {
    return null;
}

Typograghy.propTypes = {children: PropTypes.node};

function ChoicesList() {
    const [ ChoiceList , setChoiceList ] = useState() ;
    const [ ChoiceListImmuable , setChoiceListImmuable ] = useState() ;

    useEffect(() => {
        fetchMyChoice().then((data) => {
            setChoiceList(
                data["hydra:member"].map((choice) => (
                    <ChoiceItem key={choice.id} data={choice}></ChoiceItem>
                )))
            setChoiceListImmuable(
                data["hydra:member"].map((choice) => (
                    <ChoiceItem key={choice.id} data={choice}></ChoiceItem>
                )))
        });
    }, []);


    const [currentTab, setCurrentTab] = React.useState(0);

    const handleChange = (event, newTab) => {
        setCurrentTab(newTab);

        if (newTab === 0){
            setChoiceList(ChoiceListImmuable);
        } else {
            setChoiceList(ChoiceListImmuable.filter((ele) =>
                ele.props.data.lessonInformation.lesson.subject.semester.name === "S"+newTab
            ))
        }
    };

    const [semesters, setSemesters] = useState(null);

    useEffect(() => {
        // fetch tout les semestres et les gardes en json
        fetchSemesters().then((data) => {
                setSemesters(data["hydra:member"]);
            }
        );
    }, []);


    if (semesters === null) {
        return <div>Loading...</div>;
    }

    return (
        <>
        <Container>
            <Tabs
                value={currentTab}
                onChange={handleChange}
                sx={{ display:"flex", justifyContent:"wrap"}}
            >
                <Tab key="all" label={
                    <Box component="span" sx={{ color: "text.main" }}>
                        Tous les semestres
                    </Box>} sx={{ minWidth: 50 }} ></Tab>
                {semesters.map((semester) => (
                    <Tab key={semester.id} label={
                        <Box component="span" sx={{ color: "text.main" }}>
                            {semester.name}
                        </Box>} sx={{ minWidth: 50 }} />
                ))}
            </Tabs>

            <TabPanel key="all" value={currentTab} index={0}>
                <TableContainer sx={{
                    display: "flex",
                    justifyContent: "flex-start",
                    backgroundColor: "secondary.main",
                    border: 1,
                    marginBottom: 2,
                    borderRadius: "5px",
                    overflowX: "auto",
                    overflowY: "auto",
                    maxHeight: "300px",
                    borderColor: "primary.main"
                }} component={Paper}>
                    <Table sx={{
                        minWidth: 800,
                    }} size="small" aria-label="simple table">
                        <TableHead sx={{
                            backgroundColor: "primary.main",
                            position:"sticky",
                            top: 0,
                        }}>
                            <TableRow>
                                <TableCell>Matière</TableCell>
                                <TableCell align="center">Semestre</TableCell>
                                <TableCell align="center">Ressource</TableCell>
                                <TableCell align="center">Type de cours</TableCell>
                                <TableCell align="center">Nombres de groupes choisi</TableCell>
                                <TableCell align="center">Nombres de groupes à encadrer</TableCell>
                                <TableCell align="center">Nombres de groupes attribués</TableCell>
                                <TableCell align="center" />
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            { ChoiceList }
                        </TableBody>
                    </Table>
                </TableContainer>
            </TabPanel>


            {semesters.map((semester, index) => (
                <TabPanel key={semester.id} value={currentTab} index={index+1}>
                    <TableContainer sx={{
                        display: "flex",
                        justifyContent: "flex-start",
                        backgroundColor: "secondary.main",
                        border: 1,
                        marginBottom: 2,
                        borderRadius: "5px",
                        overflowX: "auto",
                        overflowY: "auto",
                        maxHeight: "300px",
                        borderColor: "primary.main"
                    }} component={Paper}>
                        <Table sx={{
                            minWidth: 800,
                        }} size="small" aria-label="simple table">
                            <TableHead sx={{
                                backgroundColor: "primary.main",
                                position:"sticky",
                                top: 0,
                            }}>
                                <TableRow>
                                    <TableCell>Matière</TableCell>
                                    <TableCell align="center">Semestre</TableCell>
                                    <TableCell align="center">Ressource</TableCell>
                                    <TableCell align="center">Type de cours</TableCell>
                                    <TableCell align="center">Nombres de groupes choisi</TableCell>
                                    <TableCell align="center">Nombres de groupes à encadrer</TableCell>
                                    <TableCell align="center">Nombres de groupes attribués</TableCell>
                                    <TableCell align="center" />
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                { ChoiceList }
                            </TableBody>
                        </Table>
                    </TableContainer>
                </TabPanel>
            ))}
        </Container>
        </>
    );
}

export default ChoicesList;