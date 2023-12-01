PGDMP         4            
    {            AutomotivosJyB    15.2    15.2 ;    C           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            D           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            E           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            F           1262    26585    AutomotivosJyB    DATABASE     �   CREATE DATABASE "AutomotivosJyB" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Bolivia.1252';
     DROP DATABASE "AutomotivosJyB";
                postgres    false            �            1259    26587 	   categoria    TABLE     �   CREATE TABLE public.categoria (
    id_categoria integer NOT NULL,
    nombre_categoria character varying(50) NOT NULL,
    estado_categoria boolean DEFAULT true
);
    DROP TABLE public.categoria;
       public         heap    postgres    false            �            1259    26586    categoria_id_categoria_seq    SEQUENCE     �   CREATE SEQUENCE public.categoria_id_categoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.categoria_id_categoria_seq;
       public          postgres    false    215            G           0    0    categoria_id_categoria_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.categoria_id_categoria_seq OWNED BY public.categoria.id_categoria;
          public          postgres    false    214            �            1259    26668    detalle_lote    TABLE     �   CREATE TABLE public.detalle_lote (
    id_lote integer NOT NULL,
    id_detalle_lote integer NOT NULL,
    id_repuesto integer NOT NULL,
    cantidad_detalle_lote smallint NOT NULL,
    submonto_lote double precision NOT NULL
);
     DROP TABLE public.detalle_lote;
       public         heap    postgres    false            �            1259    26667     detalle_lote_id_detalle_lote_seq    SEQUENCE     �   CREATE SEQUENCE public.detalle_lote_id_detalle_lote_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.detalle_lote_id_detalle_lote_seq;
       public          postgres    false    227            H           0    0     detalle_lote_id_detalle_lote_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.detalle_lote_id_detalle_lote_seq OWNED BY public.detalle_lote.id_detalle_lote;
          public          postgres    false    226            �            1259    26630    detalle_venta    TABLE     �   CREATE TABLE public.detalle_venta (
    id_venta integer NOT NULL,
    id_detalle_venta integer NOT NULL,
    id_repuesto integer NOT NULL,
    cantidad_detalle_venta smallint NOT NULL,
    submonto_venta double precision NOT NULL
);
 !   DROP TABLE public.detalle_venta;
       public         heap    postgres    false            �            1259    26629 "   detalle_venta_id_detalle_venta_seq    SEQUENCE     �   CREATE SEQUENCE public.detalle_venta_id_detalle_venta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.detalle_venta_id_detalle_venta_seq;
       public          postgres    false    221            I           0    0 "   detalle_venta_id_detalle_venta_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.detalle_venta_id_detalle_venta_seq OWNED BY public.detalle_venta.id_detalle_venta;
          public          postgres    false    220            �            1259    26654    lote    TABLE     @  CREATE TABLE public.lote (
    id_lote integer NOT NULL,
    codigo_lote character varying(50) DEFAULT NULL::character varying,
    fecha_lote timestamp(0) with time zone DEFAULT CURRENT_TIMESTAMP,
    id_proveedor integer NOT NULL,
    precio_lote double precision NOT NULL,
    saldo_lote double precision NOT NULL
);
    DROP TABLE public.lote;
       public         heap    postgres    false            �            1259    26653    lote_id_lote_seq    SEQUENCE     �   CREATE SEQUENCE public.lote_id_lote_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.lote_id_lote_seq;
       public          postgres    false    225            J           0    0    lote_id_lote_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.lote_id_lote_seq OWNED BY public.lote.id_lote;
          public          postgres    false    224            �            1259    26647 	   proveedor    TABLE       CREATE TABLE public.proveedor (
    id_proveedor integer NOT NULL,
    nombre_proveedor character varying(50) NOT NULL,
    descripcion_proveedor character varying(100) NOT NULL,
    telef_proveedor character varying(10) NOT NULL,
    estado_proveedor boolean DEFAULT true
);
    DROP TABLE public.proveedor;
       public         heap    postgres    false            �            1259    26646    proveedor_id_proveedor_seq    SEQUENCE     �   CREATE SEQUENCE public.proveedor_id_proveedor_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.proveedor_id_proveedor_seq;
       public          postgres    false    223            K           0    0    proveedor_id_proveedor_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.proveedor_id_proveedor_seq OWNED BY public.proveedor.id_proveedor;
          public          postgres    false    222            �            1259    26594    repuesto    TABLE     �  CREATE TABLE public.repuesto (
    id_repuesto integer NOT NULL,
    codigo_repuesto character varying(50) DEFAULT NULL::character varying,
    id_categoria integer NOT NULL,
    nombre_repuesto character varying(100) NOT NULL,
    descripcion_repuesto character varying(150) NOT NULL,
    medida character varying(70) DEFAULT NULL::character varying,
    stock_repuesto integer NOT NULL,
    stock_minimo integer NOT NULL,
    precio_sugerido double precision NOT NULL
);
    DROP TABLE public.repuesto;
       public         heap    postgres    false            �            1259    26593    repuesto_id_repuesto_seq    SEQUENCE     �   CREATE SEQUENCE public.repuesto_id_repuesto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.repuesto_id_repuesto_seq;
       public          postgres    false    217            L           0    0    repuesto_id_repuesto_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.repuesto_id_repuesto_seq OWNED BY public.repuesto.id_repuesto;
          public          postgres    false    216            �            1259    26608    venta    TABLE       CREATE TABLE public.venta (
    id_venta integer NOT NULL,
    fecha_venta timestamp(0) with time zone DEFAULT CURRENT_TIMESTAMP,
    precio_venta double precision NOT NULL,
    cliente character varying(70) NOT NULL,
    nit_cliente character varying(20) NOT NULL
);
    DROP TABLE public.venta;
       public         heap    postgres    false            �            1259    26607    venta_id_venta_seq    SEQUENCE     �   CREATE SEQUENCE public.venta_id_venta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.venta_id_venta_seq;
       public          postgres    false    219            M           0    0    venta_id_venta_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.venta_id_venta_seq OWNED BY public.venta.id_venta;
          public          postgres    false    218            �           2604    26590    categoria id_categoria    DEFAULT     �   ALTER TABLE ONLY public.categoria ALTER COLUMN id_categoria SET DEFAULT nextval('public.categoria_id_categoria_seq'::regclass);
 E   ALTER TABLE public.categoria ALTER COLUMN id_categoria DROP DEFAULT;
       public          postgres    false    214    215    215            �           2604    26671    detalle_lote id_detalle_lote    DEFAULT     �   ALTER TABLE ONLY public.detalle_lote ALTER COLUMN id_detalle_lote SET DEFAULT nextval('public.detalle_lote_id_detalle_lote_seq'::regclass);
 K   ALTER TABLE public.detalle_lote ALTER COLUMN id_detalle_lote DROP DEFAULT;
       public          postgres    false    227    226    227            �           2604    26633    detalle_venta id_detalle_venta    DEFAULT     �   ALTER TABLE ONLY public.detalle_venta ALTER COLUMN id_detalle_venta SET DEFAULT nextval('public.detalle_venta_id_detalle_venta_seq'::regclass);
 M   ALTER TABLE public.detalle_venta ALTER COLUMN id_detalle_venta DROP DEFAULT;
       public          postgres    false    221    220    221            �           2604    26657    lote id_lote    DEFAULT     l   ALTER TABLE ONLY public.lote ALTER COLUMN id_lote SET DEFAULT nextval('public.lote_id_lote_seq'::regclass);
 ;   ALTER TABLE public.lote ALTER COLUMN id_lote DROP DEFAULT;
       public          postgres    false    225    224    225            �           2604    26650    proveedor id_proveedor    DEFAULT     �   ALTER TABLE ONLY public.proveedor ALTER COLUMN id_proveedor SET DEFAULT nextval('public.proveedor_id_proveedor_seq'::regclass);
 E   ALTER TABLE public.proveedor ALTER COLUMN id_proveedor DROP DEFAULT;
       public          postgres    false    222    223    223            �           2604    26597    repuesto id_repuesto    DEFAULT     |   ALTER TABLE ONLY public.repuesto ALTER COLUMN id_repuesto SET DEFAULT nextval('public.repuesto_id_repuesto_seq'::regclass);
 C   ALTER TABLE public.repuesto ALTER COLUMN id_repuesto DROP DEFAULT;
       public          postgres    false    217    216    217            �           2604    26611    venta id_venta    DEFAULT     p   ALTER TABLE ONLY public.venta ALTER COLUMN id_venta SET DEFAULT nextval('public.venta_id_venta_seq'::regclass);
 =   ALTER TABLE public.venta ALTER COLUMN id_venta DROP DEFAULT;
       public          postgres    false    218    219    219            4          0    26587 	   categoria 
   TABLE DATA           U   COPY public.categoria (id_categoria, nombre_categoria, estado_categoria) FROM stdin;
    public          postgres    false    215   �H       @          0    26668    detalle_lote 
   TABLE DATA           s   COPY public.detalle_lote (id_lote, id_detalle_lote, id_repuesto, cantidad_detalle_lote, submonto_lote) FROM stdin;
    public          postgres    false    227   �H       :          0    26630    detalle_venta 
   TABLE DATA           x   COPY public.detalle_venta (id_venta, id_detalle_venta, id_repuesto, cantidad_detalle_venta, submonto_venta) FROM stdin;
    public          postgres    false    221   �H       >          0    26654    lote 
   TABLE DATA           g   COPY public.lote (id_lote, codigo_lote, fecha_lote, id_proveedor, precio_lote, saldo_lote) FROM stdin;
    public          postgres    false    225   �H       <          0    26647 	   proveedor 
   TABLE DATA           }   COPY public.proveedor (id_proveedor, nombre_proveedor, descripcion_proveedor, telef_proveedor, estado_proveedor) FROM stdin;
    public          postgres    false    223   I       6          0    26594    repuesto 
   TABLE DATA           �   COPY public.repuesto (id_repuesto, codigo_repuesto, id_categoria, nombre_repuesto, descripcion_repuesto, medida, stock_repuesto, stock_minimo, precio_sugerido) FROM stdin;
    public          postgres    false    217   �I       8          0    26608    venta 
   TABLE DATA           Z   COPY public.venta (id_venta, fecha_venta, precio_venta, cliente, nit_cliente) FROM stdin;
    public          postgres    false    219   �I       N           0    0    categoria_id_categoria_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.categoria_id_categoria_seq', 1, true);
          public          postgres    false    214            O           0    0     detalle_lote_id_detalle_lote_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.detalle_lote_id_detalle_lote_seq', 1, false);
          public          postgres    false    226            P           0    0 "   detalle_venta_id_detalle_venta_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.detalle_venta_id_detalle_venta_seq', 1, false);
          public          postgres    false    220            Q           0    0    lote_id_lote_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.lote_id_lote_seq', 1, false);
          public          postgres    false    224            R           0    0    proveedor_id_proveedor_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.proveedor_id_proveedor_seq', 2, true);
          public          postgres    false    222            S           0    0    repuesto_id_repuesto_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.repuesto_id_repuesto_seq', 1, false);
          public          postgres    false    216            T           0    0    venta_id_venta_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.venta_id_venta_seq', 1, false);
          public          postgres    false    218            �           2606    26592    categoria categoria_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id_categoria);
 B   ALTER TABLE ONLY public.categoria DROP CONSTRAINT categoria_pkey;
       public            postgres    false    215            �           2606    26673    detalle_lote detalle_lote_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.detalle_lote
    ADD CONSTRAINT detalle_lote_pkey PRIMARY KEY (id_detalle_lote);
 H   ALTER TABLE ONLY public.detalle_lote DROP CONSTRAINT detalle_lote_pkey;
       public            postgres    false    227            �           2606    26635     detalle_venta detalle_venta_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.detalle_venta
    ADD CONSTRAINT detalle_venta_pkey PRIMARY KEY (id_detalle_venta);
 J   ALTER TABLE ONLY public.detalle_venta DROP CONSTRAINT detalle_venta_pkey;
       public            postgres    false    221            �           2606    26661    lote lote_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.lote
    ADD CONSTRAINT lote_pkey PRIMARY KEY (id_lote);
 8   ALTER TABLE ONLY public.lote DROP CONSTRAINT lote_pkey;
       public            postgres    false    225            �           2606    26652    proveedor proveedor_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (id_proveedor);
 B   ALTER TABLE ONLY public.proveedor DROP CONSTRAINT proveedor_pkey;
       public            postgres    false    223            �           2606    26601    repuesto repuesto_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.repuesto
    ADD CONSTRAINT repuesto_pkey PRIMARY KEY (id_repuesto);
 @   ALTER TABLE ONLY public.repuesto DROP CONSTRAINT repuesto_pkey;
       public            postgres    false    217            �           2606    26628    venta venta_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.venta
    ADD CONSTRAINT venta_pkey PRIMARY KEY (id_venta);
 :   ALTER TABLE ONLY public.venta DROP CONSTRAINT venta_pkey;
       public            postgres    false    219            �           2606    26602    repuesto fk_id_categoria    FK CONSTRAINT     �   ALTER TABLE ONLY public.repuesto
    ADD CONSTRAINT fk_id_categoria FOREIGN KEY (id_categoria) REFERENCES public.categoria(id_categoria);
 B   ALTER TABLE ONLY public.repuesto DROP CONSTRAINT fk_id_categoria;
       public          postgres    false    3218    217    215            �           2606    26674    detalle_lote fk_id_lote    FK CONSTRAINT     z   ALTER TABLE ONLY public.detalle_lote
    ADD CONSTRAINT fk_id_lote FOREIGN KEY (id_lote) REFERENCES public.lote(id_lote);
 A   ALTER TABLE ONLY public.detalle_lote DROP CONSTRAINT fk_id_lote;
       public          postgres    false    225    227    3228            �           2606    26662    lote fk_id_proveedor    FK CONSTRAINT     �   ALTER TABLE ONLY public.lote
    ADD CONSTRAINT fk_id_proveedor FOREIGN KEY (id_proveedor) REFERENCES public.proveedor(id_proveedor);
 >   ALTER TABLE ONLY public.lote DROP CONSTRAINT fk_id_proveedor;
       public          postgres    false    225    3226    223            �           2606    26641    detalle_venta fk_id_repuesto    FK CONSTRAINT     �   ALTER TABLE ONLY public.detalle_venta
    ADD CONSTRAINT fk_id_repuesto FOREIGN KEY (id_repuesto) REFERENCES public.repuesto(id_repuesto);
 F   ALTER TABLE ONLY public.detalle_venta DROP CONSTRAINT fk_id_repuesto;
       public          postgres    false    217    3220    221            �           2606    26679    detalle_lote fk_id_repuesto    FK CONSTRAINT     �   ALTER TABLE ONLY public.detalle_lote
    ADD CONSTRAINT fk_id_repuesto FOREIGN KEY (id_repuesto) REFERENCES public.repuesto(id_repuesto);
 E   ALTER TABLE ONLY public.detalle_lote DROP CONSTRAINT fk_id_repuesto;
       public          postgres    false    227    3220    217            �           2606    26636    detalle_venta fk_id_venta    FK CONSTRAINT        ALTER TABLE ONLY public.detalle_venta
    ADD CONSTRAINT fk_id_venta FOREIGN KEY (id_venta) REFERENCES public.venta(id_venta);
 C   ALTER TABLE ONLY public.detalle_venta DROP CONSTRAINT fk_id_venta;
       public          postgres    false    221    3222    219            4      x�3�,(*MMJ�,����� '�      @      x������ � �      :      x������ � �      >      x������ � �      <   x   x�M��
� �ߧ�����l��D�ٺ��A(1�}����;NҐ����/��T�P��H5{�-y졙=�-�s�� u�_��Uёe㖉�=5�a�5�]��10�F�����2�����I�$P      6      x������ � �      8      x������ � �     