Реализация тестового задания по созданию доски поручений. Требования:
Каждое поручение имеет:

- Заголовок
- Ответственного исполнителя (ФИО)
- Куратора (ФИО)
- Срок исполнения

Создание\удаление\редактирование поручения доступно только авторизованным пользователям.
Предусмотреть разделение ролей на обычного пользователя и админа.

Пользователь:

- может создать поручение
- может посмотреть назначенные ему поручения через меню "Мои поручения"
- нельзя удалять\редактировать чужие поручения

Реализовать простую админ-панель, позволяющую админу:

- посмотреть список всех поручений
- отфильтровать поручение по заголовку, ФИО ответственного и сроку исполнения
- удалить поручение

Бонусная задача:

- в админ-панели сделать справочник пользователей с CRUD и сменой роли пользователя (Администратор, Пользователь)
-------------


Для разворачивания
1. Необходимо настроить локально БД, указать подключение в `config/db.php`, к примеру:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
2. Установить все необходимые для  Yii2 зависимости
3. Запустить composer
4. По умолчанию подразумевается два пользователя: root & user. Пароль 123
