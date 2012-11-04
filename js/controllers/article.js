function ArticleCtrl($scope) {
    $scope.articles = [
        {"name": "PHPUnit > Test Drive Bug Fixing < GitHub",
            "perex": "GitHub je geniální nástroj pro správu projektů v systému správy verzí Git. GitHub umožňuje otvírat tzv. „Issues“. Issues lze použít jako seznam bugů, na které ostatní vývojáři projektu, který sledují, narazili a bylo by vhodné je fixnout, či podniknout kroky k jejich zavření a tím i k vyřešění. PHPUnit obsahuje rozšíření, pro podporu Test Drive Bug Fixing a tím získáváme možnost, jak automatizovaně otvírat a zavírat issues v GitHubu v závislosti na úspěšnosti testů.",
            "count_posts": 10,
            "tags": [
                {"name": "selenium"},
                {"name": "phpunit"},
                {"name": "testing"},
                {"name": "gitub"}
            ]
        },
        {"name": "PHPUnit – anotace",
            "perex": "Anotace je forma metadat, která se uvádějí ke zdrojovému kódu. PHP nemá specializované funkce pro anotování zrojového kódu. Ovšem máme možnost přidat anotace do phpDoc a pomocí reflexe k nim přistupovat a tak řídit běh programu a nastavit chování metod. Pokud píšeme testy v PHPUnit, můžeme k jednotlivým testovacím metodám přidat anotaci do phpDoc a tak říci, jak se má PHPUnit při zpracování o anotované metody zachovat. Některé anotace v rámci testování můžeme uvádět i k testovanému kódu.",
            "count_posts": 12,
            "tags": [
                {"name": "selenium"},
                {"name": "phpunit"}
            ]
        },
        {"name": "PHPUnit Command-Line",
            "perex": "V milém článku jsem ukázal, jak spustit jednotkový test PHPUnit v terminálu. A však spouštění testů můžeme ovlivnit přepínači, které nám dovolí například spouštět testy, které jsou v dané skupině, z výsledků tvořit report pokrytí testované aplikace testy, obarvovat výstupy v příkazové řádce a mnoho dalšího.",
            "count_posts": 15,
            "tags": [
                {"name": "testing"},
                {"name": "gitub"}
            ]
        }
    ];
}
