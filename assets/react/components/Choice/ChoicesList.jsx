import React, {useEffect, useState} from "react";
import { Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import {fetchMyChoice} from "../../services/api/api";
import ChoiceItem from "./ChoiceItem";
import Paper from "@mui/material/Paper";


function ChoicesList() {
    const [ ChoiceList, setChoiceList ] = useState() ;

    useEffect(() => {
        fetchMyChoice().then((data) => {
            setChoiceList(
                data["hydra:member"].map((choice) => (
                    <ChoiceItem key={choice.id} data={choice}></ChoiceItem>
                ))
            );
        });
    }, []);

    return (
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
    );
}

export default ChoicesList;