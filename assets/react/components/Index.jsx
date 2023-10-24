import React, {useEffect, useState} from "react";
import {Box, Button, Table, TableContainer, TableHead, TableRow} from "@mui/material";
import useGetSemesters from "../hooks/useGetSemesters";


function Index() {
    const [semester, setSemester] = useState();
    const [semestersList, setSemesterList] = useState();
    useEffect(() => {
        useGetSemesters().then((data) => {
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
                            head
                        </TableRow>
                        </TableHead>
                    <TableRow>
                        {semester !== undefined ? <p>{semester.name}</p> : <p></p> }
                    </TableRow>
                </Table>
            </TableContainer>


        </Box>
    )
}

export default Index;