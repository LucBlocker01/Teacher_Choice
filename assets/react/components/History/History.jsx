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
import Paper from "@mui/material/Paper";
import ChoiceItemHistory from "./ChoiceItemHistory";

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
    const [years, setYears] = useState([])



    useEffect(() => {
        fetchOldChoices().then((data) => {
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

            setYears(() => {
                let tab = [];

                data["hydra:member"].map((choice) => {
                    if (!tab.includes(choice.year)) {
                        tab.push(choice.year)
                    }
                })

                return tab.sort(function(a, b){return b-a});
            })
        })
    }, []);

    console.log(years)

    const handleChange = (event, newTab) => {
        setCurrentTab(newTab);
    }

    // console.log(oldChoicesImmuable);

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
                    <Tab key={years.indexOf(year)} label={year} sx={{ minWidth: 50 }} />
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
                                    <TableCell>Semestre</TableCell>
                                    <TableCell>Ressource</TableCell>
                                    <TableCell>Type de cours</TableCell>
                                    <TableCell>Nombres de groupes attribués</TableCell>
                                    <TableCell>Nombres de groupes encadrés</TableCell>
                                    <TableCell>Year</TableCell>
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