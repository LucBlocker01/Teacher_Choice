import React, {useEffect, useState} from 'react'
import {fetchOldChoices} from "../../services/api/api";
import {
    Box,
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
import ChoiceItem from './ChoiceItem';
import Paper from "@mui/material/Paper";

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

    const [history, setHistory] = useState([])
    const [oldChoices, setOldChoices] = useState([])
    const [oldChoicesImmuable, setOldChoicesImmuable] = useState([])
    const [currentTab, setCurrentTab] = useState(0);
    const [years, setYears] = useState([ [1, '2021/2022'], [2, '2022/2023'] ])

    useEffect(() => {
        fetchOldChoices().then((data) => {
            setOldChoices(
                data["hydra:member"].map((choice) => (
                        <ChoiceItem data={choice}/>
                    )
                ))
            setOldChoicesImmuable(
                data["hydra:member"].map((choice) => (
                        <ChoiceItem choice={choice}/>
                    )
                )
            )
        })
    }, []);

    const handleChange = (event, newTab) => {
        setCurrentTab(newTab);
    }

    console.log(oldChoices);

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
                    <Tab key={year[0]} label={year[1]} sx={{ minWidth: 50 }} />
                ))}
            </Tabs>

            {years.map((year, index) => (
                <TabPanel key={year.id} value={currentTab} index={index+1}>
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
                                { oldChoicesImmuable }
                            </TableBody>
                        </Table>
                    </TableContainer>
                </TabPanel>
            ))}
        </Container>
    </>
  )
}

export default History;