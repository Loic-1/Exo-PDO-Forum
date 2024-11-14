-- used in isUniquePseudo
SELECT *
FROM user u
WHERE u.nickName = "ted"; -- current $pseudo

-- used in isUniqueMail
SELECT *
FROM user u
WHERE u.email = "test@test.fr"; -- current $mail

-- used in findPasswordByMail
SELECT *
FROM user u
WHERE u.email = "test@test.fr"; -- current $mail