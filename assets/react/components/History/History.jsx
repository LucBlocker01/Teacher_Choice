import React, {useEffect, useState} from 'react'
import {fetchOldChoices, fetchSemesterByYear} from "../../services/api/api";
import {
    Box, Button,
    Container,
    Tab,
    Table, TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Tabs,
    Typography
} from "@mui/material";
import Paper from "@mui/material/Paper";
import ChoiceItemHistory from "./ChoiceItemHistory";
import {Link} from "wouter";

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

function History() {

    const [oldChoices, setOldChoices] = useState([])
    const [oldChoicesImmuable, setOldChoicesImmuable] = useState([])
    const [currentTab, setCurrentTab] = useState(0);
    const [currentTabSemester, setCurrentTabSemester] = useState(0);
    const [years, setYears] = useState([])
    const [semesters, setSemesters] = useState(null);
    useEffect(() => {
        fetchOldChoices().then((data) => {
            setYears(() => {
                let tab = [];
                data["hydra:member"].map((choice) => {
                    if (!tab.includes(choice.lessonInformation.lesson.subject.semester.year)) {
                        tab.push(choice.lessonInformation.lesson.subject.semester.year)
                    }
                })
                return tab.sort(function(a, b){return b-a});
            })
            setOldChoices(
                data["hydra:member"].map((choice) => (
                        <ChoiceItemHistory key={choice.id} data={choice}/>
                    )
                )
            )
            setOldChoicesImmuable(
                data["hydra:member"].map((choice) => (
                        <ChoiceItemHistory key={choice.id} data={choice}/>
                    )
                )
            )
        })
    }, []);

    useEffect(() => {
        fetchSemesterByYear(years[currentTab]).then((data) => {
                setSemesters(data["hydra:member"]);
            })
        setOldChoices(oldChoicesImmuable.filter((ele) =>
            ele.props.data.lessonInformation.lesson.subject.semester.year === years[currentTab])
        );
        document.title = "SetURCAlendar - Historique"
    }, [years]);


    const handleChange = (event, newTab) => {
        setCurrentTab(newTab);
        if (currentTabSemester === 0) {
            setOldChoices(
                oldChoicesImmuable.filter((ele) =>
                    ele.props.data.lessonInformation.lesson.subject.semester.year === years[newTab]
                )
            )
        } else {
            setOldChoices(oldChoicesImmuable.filter((ele) =>
                ele.props.data.lessonInformation.lesson.subject.semester.year === years[newTab] && ele.props.data.lessonInformation.lesson.subject.semester.name === "S"+currentTabSemester
            ))
        }

    }

    const handleChangeSemester = (event, newTab) => {
        setCurrentTabSemester(newTab);
        if (newTab === 0){
            setOldChoices(oldChoicesImmuable.filter((ele) =>
                ele.props.data.lessonInformation.lesson.subject.semester.year === years[currentTab]
            ));
        } else {
            setOldChoices(oldChoicesImmuable.filter((ele) =>
                ele.props.data.lessonInformation.lesson.subject.semester.year === years[currentTab] && ele.props.data.lessonInformation.lesson.subject.semester.name === "S"+newTab
            ))
        }
    }

    if (semesters === null) {
        return <div>Loading...</div>;
    }

  return (
    <>
        <h1>Historique de vos voeux de vos année précédentes : </h1>
        <Container>
            <Tabs
                value={currentTab}
                onChange={handleChange}
                sx={{ display:"flex", justifyContent:"wrap"}}
            >
                {years.map((year) => (
                    <Tab key={years.indexOf(year)} label={
                        <Box component="span" sx={{ color: "text.main" }}>
                            {year}
                        </Box>}
                         sx={{ minWidth: 50 }} />
                ))}
            </Tabs>

            <Tabs
                value={currentTabSemester}
                onChange={handleChangeSemester}
                sx={{ display:"flex", justifyContent:"wrap"}}
            >
                <Tab key="all" label={
                    <Box component="span" sx={{ color: "text.main" }}>
                        Tous les semestres

                    </Box>}
                     sx={{ minWidth: 50 }} ></Tab>
                {semesters.map((semester) => (
                    <Tab key={semester.id} label={
                        <Box component="span" sx={{ color: "text.main" }}>
                            {semester.name}

                        </Box>}
                     sx={{ minWidth: 50 }} />
                ))}
            </Tabs>

            {years.map((year, index) => (
                <TabPanel key={years.indexOf(year)} value={currentTab} index={index}>
                    <TableContainer sx={{
                        display: "flex",
                        justifyContent: "flex-start",
                        backgroundColor: "secondary.main",
                        border: 1,
                        marginBottom: 2,
                        borderRadius: "5px",
                        overflowX: "auto",
                        overflowY: "auto",
                        maxHeight: "500px",
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
                                    <TableCell component="th" scope="row">Matière</TableCell>
                                    <TableCell align="center">Semestre</TableCell>
                                    <TableCell align="center">Ressource</TableCell>
                                    <TableCell align="center">Type de cours</TableCell>
                                    <TableCell align="center">Nombres de groupes attribués</TableCell>
                                    <TableCell align="center">Nombres de groupes encadrés</TableCell>
                                    <TableCell align="center">Année</TableCell>
                                </TableRow>
                            </TableHead>
                            <TableBody>
                                { oldChoices }
                            </TableBody>
                        </Table>
                    </TableContainer>
                </TabPanel>
            ))}
            <Link href="/react/choices/">
                <Button sx={{
                    border: 1,
                    backgroundColor: "secondary.main",
                }}>
                    Retour aux choix
                </Button>
            </Link>
        </Container>
    </>
  )
}

export default History;