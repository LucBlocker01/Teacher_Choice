import React, {useEffect, useState} from "react";
import {Button, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import {deleteChoiceById, fetchMyChoice, fetchTeacherChoice} from "../../services/api/api";
import TeacherChoiceItem from "./TeacherChoiceItem";


function TeacherChoiceList({id}){
    console.log(`Teacher id : ${id}`);
    const [ TeacherChoiceList, setTeacherChoiceList ] = useState() ;

    useEffect(() => {
        fetchTeacherChoice(id).then((data) => {
            setTeacherChoiceList(
                data["hydra:member"].map((choice) => (
                    <TeacherChoiceItem key={choice.id} data={choice}></TeacherChoiceItem>
                ))
            );
        });
    }, [id]);
    return (
        <>
        <TableContainer sx={{
            zIndex: -1,
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
                zIndex: 1,
                minWidth: 800
            }} size="small" aria-label="simple table">

                <TableHead sx={{backgroundColor: "primary.main", position:"sticky", top: 0, zIndex: 1 }}>
                    <TableRow>
                        <TableCell>Matière</TableCell>
                        <TableCell align="right">Ressource</TableCell>
                        <TableCell align="right">Nombres de groupes sélectionnés</TableCell>
                        <TableCell align="right">Nombres de groupes en tout à encadrer</TableCell>
                        <TableCell align="right">Type de cours</TableCell>
                        <TableCell align="right" >Nombre de groupes à attribués</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {TeacherChoiceList}
                </TableBody>

            </Table>
        </TableContainer>
        </>
    );
}

export default TeacherChoiceList;