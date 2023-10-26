import React, { useEffect, useState } from 'react'
import { fetchSubjectBySemester } from "../../services/api/choice";
import SubjectItem from "./SubjectItem";
import useGetMe from "../../hooks/useGetMe";

function SubjectList({ data }) {
  
    const [subjectList, setSubjectList] = useState(null);
    const [user, setUser] = useState(null);

    useGetMe().then((data) => {
        setUser(data);
    }) ;

    useEffect(() => {
        console.log(user);
        fetchSubjectBySemester(data).then((data) => {
            setSubjectList(data["hydra:member"].map((subject) => (
                <SubjectItem key={subject.id} data={subject} user={user} />
            )));
        });
    }, []);

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