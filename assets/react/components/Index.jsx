import React, {useEffect, useState} from "react";
import {
    Box,
    Button,
    Container,
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Typography
} from "@mui/material";
import {fetchSemesters} from "../services/api/choice";
import IndexRowTable from "./indexTableContent/IndexRowTable";


function Index() {
    const [semester, setSemester] = useState();
    const [semestersList, setSemesterList] = useState();
    useEffect(() => {
        fetchSemesters().then((data) => {
            setSemesterList(
                data["hydra:member"].map((semester) => (
                    <Button
                        sx={{
                        width: "12%",
                        mr: "3px",
                        fontSize: "2em",
                        backgroundColor: "accent.main",
                        color: "white"
                    }}
                        key={semester.id}
                        onClick={() => {
                            setSemester(semester)
                        }}>
                        {semester.name}
                    </Button>
                ))
            )
        })
    }, []);
    return(
        <Box sx={{
            mb: "100px",
        }}>
            <h1 className="title">Liste des matières par semestre</h1>
            <Box sx={{
                display: "flex",
                justifyContent: "center",
                mb: "5px"
            }}>
                {semestersList}
            </Box>
            {semester !== undefined ?
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
                }}>
                    <Table sx={{
                        minWidth: 600
                    }} size="small" aria-label="simple table">
                        <TableHead sx={{backgroundColor: "primary.main", position:"sticky", top: 0 }}>
                            <TableRow>
                                <TableCell>Ressource</TableCell>
                                <TableCell>Leçons</TableCell>
                                <TableCell>Tags</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                                <IndexRowTable data={semester}/>
                        </TableBody>
                    </Table>
                </TableContainer> :
                        <Container sx={{
                            backgroundColor : "primary.main",
                            display: "flex",
                            justifyContent: "center",
                            width: "15%",
                            borderRadius: "4px",
                        }}>Aucun semestre sélectionné</Container>
            }

        </Box>
    )
}

export default Index;