import React, {useEffect, useState} from "react";
import {Button, Stack, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import {fetchMyChoice} from "../services/api/api";
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
            maxHeight: "500px",
            borderColor: "primary.main"
        }} component={Paper}>
            <Table sx={{
                minWidth: 600,
            }} size="small" aria-label="simple table">
                <TableHead sx={{
                    backgroundColor: "primary.main",
                    position:"sticky",
                    top: 0,
                }}>
                    <TableRow>

                        <TableCell>Matière</TableCell>
                        <TableCell align="right">Semestre</TableCell>
                        <TableCell align="right">Ressource</TableCell>
                        <TableCell align="right">Nombres de groupes sélectionnés</TableCell>
                        <TableCell align="right">Nombres de groupes en tout à encadrer</TableCell>
                        <TableCell align="right">Nombres de groupes attribués</TableCell>
                        <TableCell align="right">Type de cours</TableCell>
                        <TableCell align="right" />
                        <TableCell align="right" />
                    </TableRow>
                </TableHead>
                <TableBody>
                    {ChoiceList}
                </TableBody>
            </Table>
        </TableContainer>
    );
}

export default ChoicesList;