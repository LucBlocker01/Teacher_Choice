import React, {useEffect, useState} from 'react'
import {fetchSubjectBySemester} from "../../services/api/choice";
import SubjectItem from "./SubjectItem";
import useGetMe from "../../hooks/useGetMe";

function SubjectList({ data }) {

    const [subjectList, setSubjectList] = useState(null);
    const [user, setUser] = useState(null);
    const [expanded, setExpanded] = useState(false);

    const handleChangeAccordion = (panel) => (event, isExpanded) => {
        setExpanded(isExpanded ? panel : false);
    }

    //useEffect pour récupérer l'utilisateur connecté
    useEffect(() => {
        const userFetch = async () => {
            const user = await useGetMe();
            setUser(user);
        };
        userFetch();
    }, [expanded]);

    useEffect(() => {
        console.log(user);
        fetchSubjectBySemester(data).then((data) => {
            setSubjectList(data["hydra:member"].map((subject) => (
                <SubjectItem key={subject.id} data={subject} user={user} handleChangeAccordion={handleChangeAccordion} expanded={expanded} />
            )));
        });
    }, [user]);

    if (subjectList === null) {
        return <div>Loading...</div>;
    }

    return (
    <div>
        {subjectList}
    </div>
  )
}

export default SubjectList