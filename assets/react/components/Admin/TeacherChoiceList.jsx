import React, {useEffect, useState} from "react";
import {Button, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import {deleteChoiceById, fetchMyChoice, fetchTeacherChoice} from "../../services/api/api";
import ChoiceItem from "../ChoiceItem";

function TeacherChoiceList({id}){
    console.log(`Teacher id : ${id}`);
    const [ TeacherChoiceList, setTeacherChoiceList ] = useState() ;

    useEffect(() => {
        fetchTeacherChoice(id).then((data) => {
            setTeacherChoiceList(
                data["hydra:member"].map((choice) => (
                    <ChoiceItem key={choice.id} data={choice}></ChoiceItem>
                ))
            );
        });
    }, [id]);

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
        }} >
            <Table sx={{
                minWidth: 600
            }} size="small" aria-label="simple table">
                <TableHead sx={{backgroundColor: "primary.main", position:"sticky", top: 0 }}>
                    <TableRow>
                        <TableCell>Matière</TableCell>
                        <TableCell align="right">Ressource</TableCell>
                        <TableCell align="right">Nombres de groupes sélectionnés</TableCell>
                        <TableCell align="right">Nombres de groupes en tout à encadrer</TableCell>
                        <TableCell align="right">Type de cours</TableCell>
                        <TableCell align="right" />
                        <TableCell align="right" />
                    </TableRow>
                </TableHead>
                <TableBody>
                    {TeacherChoiceList}
                </TableBody>
            </Table>
        </TableContainer>
    );
}

export default TeacherChoiceList;