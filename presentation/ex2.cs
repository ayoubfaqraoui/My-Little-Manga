using System;

namespace exercice2
{
    internal class Program
    {
        static void Main(string[] args)
        {
            int num;

            int[] array = new int[6];
            array[0] = 1;
            array[1] = 5;
            array[2] = 11;
            array[3] = 20;
            array[4] = 120;
            array[5] = 122;



           
            for (int i = 0; i < array.Length; i++)
            {
                Console.Write( array[i]);
            }

       

            do
            {

                Console.WriteLine("\n entrer un nombre");

            } while (!(int.TryParse(Console.ReadLine(), out num)));


            
            insert(ref array, num);

           
            Console.WriteLine("le tableau trié");
            for (int i = 0; i < array.Length; i++)
            {
                Console.Write( array[i]);
            }


        }
        static void insert(ref int[] array, int num)
        {
            
            bool b = false;
            int temp = 1;
            int temp2;

      
            Array.Resize<int>(ref array, array.Length + 1);

            for (int i = 0; i < array.Length - 1; i++)
            {
                if (array[i] > num || b == true)
                {

                    if (!b)
                    {
                        temp = array[i];
                        array[i] = num;
                        b = true;
                    }
                    temp2 = array[i + 1];
                    array[i + 1] = temp;
                    temp = temp2;


                }

            }
            if (!b)
            {
                array[6] = num;
            }

        }
    }
}