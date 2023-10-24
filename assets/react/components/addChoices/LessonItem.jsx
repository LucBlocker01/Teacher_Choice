import React, {useEffect, useState} from 'react'
import useGetMe from "../../hooks/useGetMe";
import {postChoice} from "../../services/api/choice";

function LessonItem({data}) {

    const [user, setUser] = useState(useGetMe(user, setUser));

    //User
    useEffect(() => {
        useGetMe().then((data) => {
            setUser(data);
        })
    }, [])
    const submitChoice = (event) => {
        event.preventDefault();
        const year = new Date().getFullYear().toString();
        const lessonInformation = data["@id"];
        const nbGroupSelectedTemp = event.target[0].value;
        const nbGroupSelected = parseInt(nbGroupSelectedTemp);
        const teacher = "/api/users/"+event.target[1].value;

        //verif valeur au dessus du nombre possible et inférieur à 0 ou 0
        const dataPost = {
            teacher,
            lessonInformation,
            nbGroupSelected,
            year
        }
        postChoice(dataPost)
        console.log({teacher, lessonInformation, nbGroupSelected, year});
  }

  return (
    <div>
      {data.lessonType.name}
      <form onSubmit={submitChoice}>
        <input name='nbGroupe' type='number' placeholder='1'/>
        <input name='userID' type='hidden' value={user.id} />
        <button type='submit'>Choisir</button>
      </form>
      </div>
  )
}

export default LessonItem