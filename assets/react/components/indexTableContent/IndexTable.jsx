import {Container, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import IndexRowTable from "./IndexRowTable";
import React, {useEffect, useState} from "react";


function IndexTable({semester, searchInput}) {
    const [newSemester, setNewSemester] = useState();
    useEffect(() => {
        setNewSemester(semester)
    }, [semester])
    return (
        <>
        {newSemester !== undefined ?
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
                    minWidth: 800
                }} size="small" aria-label="simple table">
                    <TableHead sx={{backgroundColor: "primary.main", position:"sticky", top: 0 }}>
                        <TableRow>
                            <TableCell>Ressource</TableCell>
                            <TableCell>Leçons</TableCell>
                            <TableCell>Tags</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        <IndexRowTable data={newSemester} searchInput={searchInput}/>
                    </TableBody>
                </Table>
            </TableContainer> :
            <Container sx={{
                backgroundColor : "primary.main",
                display: "flex",
                justifyContent: "center",
                width: "15%",
                borderRadius: "4px",
            }}>Chargement...</Container>
        }
        </>
    )
}

export default IndexTable;